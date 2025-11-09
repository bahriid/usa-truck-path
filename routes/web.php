<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminEnrollmentController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


// Dashboard - shows courses in user's funnel
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    Route::name('front.')->group(function () {

      Route::get('/',[PageController::class,'home'])->name('home');

    // New category placeholders
    //Route::get('/category/{slug}', [PageController::class, 'courseCategory'])->name('course.category');

     Route::any('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

      Route::get('about-us',[PageController::class,'about_us'])->name('about_us');
      Route::get('how-it-works',[PageController::class,'how_it_works'])->name('how_it_works');
      Route::get('contact-us',[PageController::class,'contact_us'])->name('contact_us');
      Route::get('terms-condition',[PageController::class,'terms_condition'])->name('terms_condition');
      Route::get('privacy-policy',[PageController::class,'privacy_policy'])->name('privacy_policy');
      Route::get('courses',[PageController::class,'course'])->name('course');
      Route::get('courses-details/{slug}',[PageController::class,'coursedetails'])->name('course.details');
      Route::get('/course-category/{category}', [PageController::class, 'courseCategory'])->name('course.category');

      // Purchase route (requires auth)
    Route::post('/courses/{course}/purchase', [App\Http\Controllers\PurchaseController::class, 'purchase'])->name('course.purchase');


      // Step 1: Show enrollment form
            Route::get('/courses/{course}/enroll', [EnrollmentController::class, 'showEnrollForm'])
            ->name('courses.enrollForm');

        // Step 2: Process enrollment form
        Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'processEnrollForm'])
            ->name('courses.processEnroll');

        // Step 3: Payment instructions
        Route::get('/courses/{course}/payment-instructions', [EnrollmentController::class, 'paymentInstructions'])
            ->name('courses.paymentInstructions');
        Route::get('/courses/{course}/paypal/initiate', [EnrollmentController::class, 'initiatePaypalPayment'])->name('courses.paypal.initiate');
        Route::get('/courses/{course}/paypal/success', [EnrollmentController::class, 'handlePaypalSuccess'])->name('courses.success');
        Route::get('/courses/{course}/paypal/cancel', [EnrollmentController::class, 'handlePaypalCancel'])->name('courses.cancel');

    });

    Route::get('/course-curriculam/{course}',[EnrollmentController::class,'showCurriculam'])->name('course.curriculam');

Route::get('/telegram-group/{course}', [EnrollmentController::class, 'redeemTelegramInvite'])->middleware('auth')->name('telegram.invite.redeem');

// Payment checkout for enrollments
Route::post('/payemnt/checkout',[EnrollmentController::class,'createStripeCheckoutSession'])->name('stripe.checkout');

Route::get('/enrollment/success', [EnrollmentController::class, 'handleSuccessfulPayment'])->name('enrollment.success');
Route::get('/enrollment/failure', [EnrollmentController::class, 'handleFailedPayment'])->name('enrollment.failure');

Route::get('/enrollment/failure/show', [EnrollmentController::class, 'showFailurePage'])->name('enrollment.failure.view');

Route::get('/stripe',[EnrollmentController::class,'payment'])->name('stripe.payment');
Route::get('/stripe',[EnrollmentController::class,'success'])->name('stripe.payment.success');

// Tier upgrade routes
Route::get('/tier-upgrade/{course}/{tier}', [EnrollmentController::class, 'showTierUpgradePage'])
    ->middleware(['auth'])
    ->name('tier.upgrade.page');
Route::post('/tier-upgrade/checkout', [EnrollmentController::class, 'createTierUpgradeCheckout'])
    ->middleware(['auth'])
    ->name('tier.upgrade.checkout');
Route::get('/tier-upgrade/success', [EnrollmentController::class, 'handleTierUpgradeSuccess'])
    ->middleware(['auth'])
    ->name('tier.upgrade.success');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


// ####################################################### Admin route start ########################################

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate']);
    Route::any('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');


         Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts');
        Route::post('/contacts/{id}/status', [ContactController::class, 'updateStatus']);



          Route::resource('courses', CourseController::class)->names('admin.courses');
          Route::resource('sliders', SliderController::class);
           // settings
           Route::prefix('settings')->name('settings.')->group(function () {

            Route::get('site-settings', [SettingController::class, 'site_setting'])->name('site_settings');
            Route::post('site-settings', [SettingController::class, 'update_site_setting'])->name('site_settings.update');

            });

        // Nested resource routes for course contents under courses
            Route::resource('courses.contents', CourseContentController::class);


        // Chapters nested under courses

        Route::resource('courses.chapters', ChapterController::class)->names('chapters');
        Route::post('/chapters/reorder', [ChapterController::class, 'reorder'])->name('chapters.reorder');



        // Topics nested under chapters (which are under courses)

        Route::resource('courses/{course}/chapters/{chapter}/topics', TopicController::class)
        ->names('topics');
        Route::post('/upload/chunk', [\App\Http\Controllers\Admin\FileUploadController::class, 'uploadChunk'])
    ->name('files.upload.chunk');


        Route::get('/enrollments', [AdminEnrollmentController::class, 'index'])->name('admin.enrollment.index');
        Route::get('/enrollments/export', [AdminEnrollmentController::class, 'export'])->name('admin.enrollment.export');

        // new transactions
        Route::get('/transactions',[AdminEnrollmentController::class,'transactions'])->name('admin.transaction.index');

                Route::delete('/user/{user}',[AdminEnrollmentController::class,'destroyUser'])->name('admin.user.delete');



        Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('admin.users.show');
        Route::get('/users/{id}/change-password', [\App\Http\Controllers\Admin\AdminUserController::class, 'editPassword'])->name('admin.users.changePassword');
        Route::post('/users/{id}/change-password', [\App\Http\Controllers\Admin\AdminUserController::class, 'updatePassword'])->name('admin.users.updatePassword');

        Route::put('/admin/enrollment/{id}/update-status', [AdminEnrollmentController::class, 'updateStatus'])
    ->name('admin.enrollment.updateStatus');

       Route::get('/legal', [\App\Http\Controllers\Admin\LegalController::class, 'index'])->name('admin.legal.index');
    Route::post('/legal/update', [\App\Http\Controllers\Admin\LegalController::class, 'update'])->name('admin.legal.update');



    });
});

// ####################################################### Admin route End ########################################


require __DIR__.'/auth.php';
