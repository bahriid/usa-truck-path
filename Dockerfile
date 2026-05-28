# Global build args — must be declared BEFORE the first FROM so they're
# in scope for every stage's FROM line. Re-declare inside a stage only if
# you also need them in RUN/COPY there.
ARG NODE_VERSION=20
ARG PHP_VERSION=8.3

# ============================================================
# Stage 0 — pull Node binaries pinned to NODE_VERSION (consumed by the
# frontend stage, which uses PHP as its base so Wayfinder can run).
# ============================================================
FROM node:${NODE_VERSION}-alpine AS node-src

# ============================================================
# Stage 1 — build frontend assets (Vite / Inertia React / Tailwind v4)
#
# Uses PHP as the base because @laravel/vite-plugin-wayfinder shells out
# to `php artisan wayfinder:generate` during `vite build`. Node is copied
# in from the official node image so NODE_VERSION is still respected.
# ============================================================
FROM php:${PHP_VERSION}-cli-alpine AS frontend

COPY --from=node-src /usr/local/bin/node /usr/local/bin/node
COPY --from=node-src /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx \
    && apk add --no-cache git unzip libstdc++

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /build

# composer deps first (cached unless composer files change) — Wayfinder
# needs to boot Laravel, which needs vendor/. We --ignore-platform-reqs here
# because this stage's php-cli-alpine doesn't carry bcmath/intl/etc. — those
# live in the runtime stage. Booting Laravel for `php artisan
# wayfinder:generate` doesn't actually exercise them.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist \
    --no-interaction --ignore-platform-reqs

# npm deps next
COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund

# Full source needed: vite.config + tsconfig + resources + public + any
# component config (components.json, etc.). Cheaper than enumerating.
COPY . .

RUN composer dump-autoload --no-dev --optimize \
    && npm run build

# ============================================================
# Stage 2 — PHP runtime (nginx + php-fpm under supervisord)
# ============================================================
FROM php:${PHP_VERSION}-fpm-alpine AS base

RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    curl \
    git \
    unzip \
    netcat-openbsd \
    libpng libpng-dev \
    libjpeg-turbo libjpeg-turbo-dev \
    freetype freetype-dev \
    libzip libzip-dev \
    icu icu-dev \
    oniguruma oniguruma-dev \
    libpq postgresql-dev \
    mysql-client \
    autoconf gcc g++ make linux-headers \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) \
       pdo_mysql \
       pdo_pgsql \
       bcmath \
       gd \
       intl \
       opcache \
       pcntl \
       zip \
       exif \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && apk del autoconf gcc g++ make linux-headers libpng-dev libjpeg-turbo-dev \
            freetype-dev libzip-dev icu-dev oniguruma-dev postgresql-dev \
  && rm -rf /tmp/* /var/cache/apk/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ---------- deps layer (cached unless composer files change) ----------
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-interaction

# ---------- app code ----------
COPY . .

# ---------- compiled frontend from stage 1 ----------
COPY --from=frontend /build/public/build ./public/build

RUN composer dump-autoload --optimize --classmap-authoritative \
    && php artisan package:discover --ansi \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

# ---------- runtime configs ----------
COPY docker/nginx.conf       /etc/nginx/nginx.conf
COPY docker/site.conf        /etc/nginx/http.d/default.conf
COPY docker/php-fpm.conf     /usr/local/etc/php-fpm.d/zz-app.conf
COPY docker/php.ini          /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh    /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

EXPOSE 80

ENTRYPOINT ["entrypoint"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
