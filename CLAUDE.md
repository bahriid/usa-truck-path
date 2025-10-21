# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 11 course management platform for CDL (Commercial Driver's License) training. The application features:
- Course catalog with enrollment and payment processing (Stripe/PayPal)
- Dual authentication system (users and admins)
- Telegram group integration for course communities
- Content management with chapters, topics, and various content types

## Development Commands

### Setup
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=AdminSeeder  # Create admin account
```

### Development
```bash
# Start all development services (server, queue, logs, vite) - recommended
composer dev

# Individual services
php artisan serve                    # Start Laravel dev server
php artisan queue:listen --tries=1   # Run queue worker
php artisan pail --timeout=0         # View logs in real-time
npm run dev                          # Start Vite dev server
```

### Testing
```bash
php artisan test                     # Run all tests
php artisan test --filter=TestName   # Run specific test
```

### Code Quality
```bash
php artisan pint                     # Format code (Laravel Pint)
```

### Build
```bash
npm run build                        # Build frontend assets for production
vite build                           # Alternative build command
```

### Database
```bash
php artisan migrate                  # Run migrations
php artisan migrate:fresh --seed     # Fresh migration with seeding
php artisan db:seed                  # Run seeders
```

## Architecture

### Authentication System
- **Dual guard system** defined in `config/auth.php`:
  - `web` guard for regular users (User model)
  - `admin` guard for administrators (Admin model)
- Routes prefixed with `/admin` use `auth:admin` middleware
- Users require email verification (`MustVerifyEmail` interface)

### Course Content Hierarchy
```
Course
├── Chapters (ordered, nested under courses)
│   └── Topics (nested under chapters)
│       ├── Types: video, pdf, audio, text, quiz
│       └── Files stored in public/storage
└── Students (many-to-many via course_user pivot)
    └── Pivot fields: status, transaction_id, telegram_invite_link, etc.
```

### Course Detail Pages (IMPORTANT)
**Course detail pages are HARDCODED landing page templates**, not dynamic. See `PageController::coursedetails()`:
- Route uses slug: `/courses-details/{slug}`
- Controller maps specific course IDs to specific blade files (lines 88-110 in `app/Http/Controllers/PageController.php`)
- Each course has its own custom marketing landing page in `resources/views/front/`
- Examples:
  - Course ID 9 → `commercial-leaner-s-permit-clp-english.blade.php` (3,430 lines)
  - Course ID 15 → `cdl-canada.blade.php` (Canadian drivers → USA)
  - Course ID 16 → `cdl-europe.blade.php` (European drivers → North America)
  - Course ID 17 → `cdl-global.blade.php` (Worldwide → North America)
  - Course ID 18 → `cdl-test-course.blade.php` (Starting a trucking company)
  - Course ID 19 → `cdl-dispatcher.blade.php` (Freight broker/dispatcher training)

**What's hardcoded in each blade file**:
- Hero short descriptions (completely hardcoded, no database fallback)
- "About This Course" section with bullet points (replaces `$course->description`)
- Marketing copy and feature descriptions
- Testimonials and customer reviews
- "What's Included" and "Why Choose" sections
- Closing CTA sections with emoji headings
- Layout, styling, and presentation

**What comes from database** (via `$course` variable):
- Course title, price, image
- Course ID (for enrollment links)
- **Full curriculum** (chapters and topics dynamically loaded)

**To add a new course**:
1. Create course in admin panel (gets auto-assigned ID)
2. Design custom landing page blade file in `resources/views/front/`
3. Add ID-to-view mapping in `PageController::coursedetails()`
4. If course ID not in mapping or view doesn't exist, returns 404

### Enrollment Flow
1. User views course details (`/courses-details/{slug}`)
2. User submits enrollment form (`/courses/{course}/enroll`)
3. Payment processing via Stripe or PayPal
4. Enrollment status tracked in `course_user` pivot table
5. Admin approves enrollment in admin panel
6. Approved users get Telegram group invite link (one-time use)

### Payment Integration
- **Stripe**: Checkout sessions created in `EnrollmentController::createStripeCheckoutSession`
- **PayPal**: Integration via `srmklive/paypal` package (config in `config/paypal.php`)
- Transaction amounts stored in `course_user.transaction_amount`

### File Uploads
- Uses `pion/laravel-chunk-upload` for large file uploads
- Chunk upload endpoint: `/admin/upload/chunk`
- Course content files processed via `ProcessCourseContentUpload` job queue

### Telegram Integration
- `TelegramService` in `app/Services/TelegramService.php`
- Creates one-time invite links when enrollment is approved
- Requires `TELEGRAM_BOT_TOKEN` in `.env`
- Course must have `telegram_chat_id` configured

### Route Structure
- **Frontend routes**: Defined in `routes/web.php` under `front.*` namespace
- **Admin routes**: Prefixed with `/admin`, use resource controllers
- **Nested resources**: Chapters under courses, topics under chapters
- **Auth routes**: Laravel Breeze authentication in `routes/auth.php`

### Database
- Default: SQLite (`DB_CONNECTION=sqlite` in `.env.example`)
- Queue driver: `database` (requires `jobs` table)
- Session driver: `database` (requires `sessions` table)
- Important pivot table: `course_user` (enrollment data with payment info)

### Frontend Stack
- Vite for asset building
- Tailwind CSS with forms plugin
- Alpine.js for interactive components
- Axios for HTTP requests
- Blade templates in `resources/views/`

### Mail System
- Configured in `.env` (`MAIL_MAILER`, default is `log`)
- Key emails:
  - `WelcomeEmail`: Sent to new users
  - `EnrollmentStatusUpdatedMail`: Sent when enrollment approved/rejected
  - `NewCoursePurchaseNotification`: Sent to admin on new purchase
  - `ContactAdminMail` / `ContactUserMail`: Contact form emails

### Admin Panel Features
- Dashboard at `/admin/dashboard`
- Course management (CRUD with nested chapters/topics)
- User management with password reset capability
- Enrollment approval workflow
- Transaction history
- Site settings (stored in `site_settings` table)
- Legal pages editor (terms, privacy policy)
- Contact form submissions

## Important Notes

- Admin users and regular users are separate tables/guards
- Course enrollment requires admin approval before curriculum access
- Topics support multiple content types (video, pdf, audio, text, quiz)
- Chapters and topics have ordering functionality
- Large file uploads handled via chunked upload to prevent timeouts
- Telegram invite links are single-use and generated per user
- Courses can have both `price` and `original_price` (for showing discounts)
