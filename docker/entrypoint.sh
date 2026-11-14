#!/bin/sh
set -e

# nginx (running as www-data) needs to write its client-body temp buffer.
# The base alpine image ships `/var/lib/nginx` as `drwxr-x--- nginx:nginx`,
# so www-data can't even traverse into it. Chown the whole tree so multipart
# uploads (admin image uploads, etc.) don't 500 with "Permission denied".
if [ -d /var/lib/nginx ]; then
    chown -R www-data:www-data /var/lib/nginx
fi

# The app_storage volume mounts over /var/www/html/storage and starts empty,
# which hides the framework dirs baked into the image. Recreate them on every
# boot so Laravel can write cache/sessions/views/logs AND persist user uploads
# (storage/app/public) across deploys.
mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache


# Wait for DB to be reachable (best-effort, short timeout)
if [ -n "$DB_HOST" ]; then
    echo "waiting for ${DB_HOST}:${DB_PORT:-3306}..."
    for i in $(seq 1 30); do
        if nc -z "$DB_HOST" "${DB_PORT:-3306}" 2>/dev/null; then
            echo "db is up"
            break
        fi
        sleep 1
    done
fi

# Only the web container runs migrations + caches.
# Queue & scheduler containers set ROLE=worker / ROLE=scheduler to skip.
if [ "${ROLE:-web}" = "web" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan migrate --force
    php artisan storage:link || true

    # Opt-in seeding. Set SEED_ON_BOOT=true on the server's .env, restart the
    # container once, then unset it (otherwise seeders re-run on every restart
    # and most aren't idempotent).
    if [ "${SEED_ON_BOOT:-false}" = "true" ]; then
        echo "SEED_ON_BOOT=true — running db:seed"
        php artisan db:seed --force
    fi
fi

exec "$@"
