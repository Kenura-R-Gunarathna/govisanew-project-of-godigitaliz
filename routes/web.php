<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\BookingController;
use App\Http\Controllers\Account\DocumentController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Account\ChatController;
use App\Http\Controllers\Account\BillingController;
use App\Http\Controllers\Account\TestimonialController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReviewsController as AdminReviewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\BillingController as AdminBillingController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;

Auth::routes();

Route::controller(HomeController::class)->group(function () {

    Route::get('/',                             'index');
    Route::get('/home',                         'index')->name('home');
    Route::get('/contact-us',                   'getContactUsPage')->name('contact');
    Route::get('/privacy',                      'getPrivacyPage')->name('privacy');
    Route::get('/terms-of-service',             'getTermsOfServicePage')->name('terms-of-service');
    Route::get('/about-us',                     'getAboutUsPage')->name('about-us');
    Route::get('/faq',                          'getFaqPage')->name('faq');
    Route::get('/search',                       'getSearch')->name('search');
    Route::get('/profile/{slug}',               'getProfile')->name('profile');
    Route::post('/profile/{slug}/review',       'createReview')->name('profile.create.review');
    Route::get('/category/{category}',          'getByCategory')->name('category');
    Route::post('/get-available-time-slots',    'getAvailableTimeSlotsByDay');
    Route::post('/confirm-booking',             'confirmBooking')->name('confirm-booking');
    Route::post('/review/store',                'createReview')->name('review.store');
    Route::post('/contact/process',             'sendContactMessage')->name('contact.process');
    Route::get('/search/suggestions',           'getSearchSuggestions')->name('search.suggestions');
});

Route::get('/google/connect',                   [GoogleController::class, 'connect'])->name('google.connect');;
Route::get('/google/callback',                  [GoogleController::class, 'callback']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('account')->name('account.')->group(function () {

        Route::get('/',                                     [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile',                              [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/user',                        [ProfileController::class, 'updateUser'])->name('profile.user.update');
        Route::get('/profile/user/booking/datatable',       [BookingController::class, 'getDatatable'])->name('profile.user.booking.datatable');
        Route::post('/profile/user/booking/update/{id}',    [BookingController::class, 'updateStatus'])->name('profile.user.booking.update');
        Route::post('/profile/provider',                    [ProfileController::class, 'updateProvider'])->name('profile.provider.update');

        Route::get('/documents',                            [DocumentController::class, 'index'])->name('documents.verify');
        Route::get('/documents/create',                     [DocumentController::class, 'create'])->name('documents.create');
        Route::post('/documents/store',                     [DocumentController::class, 'store'])->name('documents.store');
        Route::get('/documents/edit/{id}',                  [DocumentController::class, 'edit'])->name('documents.edit');
        Route::post('/documents/update/{id}',               [DocumentController::class, 'update'])->name('documents.update');

        Route::get('/settings/change_password',             [SettingsController::class, 'changePassword'])->name('settings.change_password');
        Route::post('/settings/update/change_password',     [SettingsController::class, 'updatePasswordChange'])->name('settings.update.change_password');

        Route::get('/chat',                                 [ChatController::class, 'index'])->name('chat');

        Route::get('/billing',                              [BillingController::class, 'index'])->name('billing');
        Route::get('/billing/plan/{plan}',                  [BillingController::class, 'show'])->name('billing.show');
        Route::post('/billing/create',                      [BillingController::class, 'create'])->name('billing.create');
        Route::get('/billing/cancel/plan/{id}',             [BillingController::class, 'cancel'])->name('billing.cancel');

        Route::get('/booking',                              [BookingController::class, 'index'])->name('booking');

        Route::get('/testimonials',                         [TestimonialController::class, 'index'])->name('testimonials');
        Route::get('/testimonials/edit/{id}',               [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::get('/testimonials/create',                  [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials/store',                  [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::post('/testimonials/update/{id}',            [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/delete/{id}',          [TestimonialController::class, 'delete'])->name('testimonials.delete');

        Route::post('/send-message',                        [ChatController::class, 'sendMessage']);
        Route::get('/load-chat/{id}',                       [ChatController::class, 'loadChat']);
        Route::get('/load-chat-ajax/{id}',                  [ChatController::class, 'loadChatAjx']);
    });


    Route::middleware(['role.admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/',                                     [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/booking',                              [AdminBookingController::class, 'index'])->name('booking');
        Route::get('/booking/datatable',                    [AdminBookingController::class, 'datatable'])->name('booking.datatable');
        Route::post('/booking/update/{id}',                 [AdminBookingController::class, 'update'])->name('booking.update');
        Route::delete('/booking/delete/{id}',               [AdminBookingController::class, 'delete'])->name('booking.delete');

        Route::get('/reviews',                              [AdminReviewsController::class, 'index'])->name('reviews');
        Route::get('/reviews/edit/{id}',                    [AdminReviewsController::class, 'edit'])->name('reviews.edit');
        Route::get('/reviews/datatable',                    [AdminReviewsController::class, 'datatable'])->name('reviews.datatable');
        Route::post('/reviews/update/{id}',                 [AdminReviewsController::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/delete/{id}',               [AdminReviewsController::class, 'delete'])->name('reviews.delete');

        Route::get('/users',                                [AdminUserController::class, 'index'])->name('users');
        Route::get('/users/datatable',                      [AdminUserController::class, 'datatable'])->name('users.datatable');
        Route::get('/users/edit/{id}',                      [AdminUserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{id}',                   [AdminUserController::class, 'update'])->name('users.update');

        Route::get('/testimonials',                         [AdminTestimonialController::class, 'index'])->name('testimonials');
        Route::get('/testimonials/edit/{id}',               [AdminTestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::post('/testimonials/update/{id}',            [AdminTestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/delete/{id}',          [AdminTestimonialController::class, 'delete'])->name('testimonials.delete');

        Route::get('/transactions',                         [AdminTransactionController::class, 'index'])->name('transactions');

        Route::get('/billing',                                              [AdminBillingController::class, 'index'])->name('billing');
        Route::get('/billing/show/{id}',                                    [AdminBillingController::class, 'show'])->name('billing.show');
        Route::get('/billing/plan/edit/{plan_id}/feature/{feature_id}',     [AdminBillingController::class, 'editFeature'])->name('billing.edit.feature');
        Route::post('/billing/plan/update/{plan_id}/feature/{feature_id}',  [AdminBillingController::class, 'updateFeature'])->name('billing.update.feature');
        Route::delete('/billing/feature/delete/{id}',                       [AdminBillingController::class, 'deleteFeature'])->name('billing.feature.delete');

        Route::get('/documents',                                            [AdminDocumentController::class, 'index'])->name('documents');
        Route::get('/documents/edit/{id}',                                  [AdminDocumentController::class, 'edit'])->name('documents.edit');
        Route::post('/documents/update/{id}',                               [AdminDocumentController::class, 'update'])->name('documents.update');
        Route::delete('/documents/delete/{id}',                             [AdminDocumentController::class, 'delete'])->name('documents.delete');
    });
});
