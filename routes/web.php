<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController;

Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/',  'index');
    Route::get('/home',  'index')->name('home');
    Route::get('/contact-us',  'getContactUsPage')->name('contact');
    Route::get('/privacy',  'getPrivacyPage')->name('privacy');
    Route::get('/terms-of-service',  'getTermsOfServicePage')->name('terms-of-service');
    Route::get('/about-us',  'getAboutUsPage')->name('about-us');
    Route::get('/faq',  'getFaqPage')->name('faq');
    Route::get('/search',  'getSearch')->name('search');
    Route::get('/profile/{slug}',  'getProfile')->name('profile');
    Route::post('/profile/{slug}/review',  'createReview')->name('profile.create.review');
    Route::get('/category/{category}',  'getByCategory')->name('category');
    Route::post('/get-available-time-slots',  'getAvailableTimeSlotsByDay');
    Route::post('/confirm-booking',  'confirmBooking')->name('confirm-booking');
    Route::post('/review/store',  'createReview')->name('review.store');
    Route::post('/contact/process',  'sendContactMessage')->name('contact.process');
    Route::get('/search/suggestions',  'getSearchSuggestions')->name('search.suggestions');
});

Route::get('/google/connect', [GoogleController::class, 'connect'])->name('google.connect');;
Route::get('/google/callback', [GoogleController::class, 'callback']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('account')->name('account.')->group(function () {

        Route::get('/',             'App\Http\Controllers\Account\DashboardController@index')->name('dashboard');

        Route::get('/profile',             'App\Http\Controllers\Account\ProfileController@index')->name('profile');
        Route::post('/profile/user',       'App\Http\Controllers\Account\ProfileController@updateUser')->name('profile.user.update');
        Route::get('/profile/user/booking/datatable',       'App\Http\Controllers\Account\BookingController@getDatatable')->name('profile.user.booking.datatable');
        Route::post('/profile/user/booking/update/{id}',       'App\Http\Controllers\Account\BookingController@updateStatus')->name('profile.user.booking.update');
        Route::post('/profile/provider',   'App\Http\Controllers\Account\ProfileController@updateProvider')->name('profile.provider.update');

        Route::get('/documents',              'App\Http\Controllers\Account\DocumentController@index')->name('documents.verify');
        Route::get('/documents/create',       'App\Http\Controllers\Account\DocumentController@create')->name('documents.create');
        Route::post('/documents/store',       'App\Http\Controllers\Account\DocumentController@store')->name('documents.store');
        Route::get('/documents/edit/{id}',    'App\Http\Controllers\Account\DocumentController@edit')->name('documents.edit');
        Route::post('/documents/update/{id}', 'App\Http\Controllers\Account\DocumentController@update')->name('documents.update');

        Route::get('/settings/change_password',          'App\Http\Controllers\Account\SettingsController@changePassword')->name('settings.change_password');
        Route::post('/settings/update/change_password',  'App\Http\Controllers\Account\SettingsController@updatePasswordChange')->name('settings.update.change_password');

        Route::get('/chat',  'App\Http\Controllers\Account\ChatController@index')->name('chat');

        Route::get('/billing',  'App\Http\Controllers\Account\BillingController@index')->name('billing');
        Route::get('/billing/plan/{plan}',  'App\Http\Controllers\Account\BillingController@show')->name('billing.show');
        Route::post('/billing/create',  'App\Http\Controllers\Account\BillingController@create')->name('billing.create');
        Route::get('/billing/cancel/plan/{id}',  'App\Http\Controllers\Account\BillingController@cancel')->name('billing.cancel');

        Route::get('/booking',  'App\Http\Controllers\Account\BookingController@index')->name('booking');

        Route::get('/testimonials',               'App\Http\Controllers\Account\TestimonialController@index')->name('testimonials');
        Route::get('/testimonials/edit/{id}',          'App\Http\Controllers\Account\TestimonialController@edit')->name('testimonials.edit');
        Route::get('/testimonials/create',        'App\Http\Controllers\Account\TestimonialController@create')->name('testimonials.create');
        Route::post('/testimonials/store',        'App\Http\Controllers\Account\TestimonialController@store')->name('testimonials.store');
        Route::post('/testimonials/update/{id}',  'App\Http\Controllers\Account\TestimonialController@update')->name('testimonials.update');
        Route::delete('/testimonials/delete/{id}',       'App\Http\Controllers\Account\TestimonialController@delete')->name('testimonials.delete');

        Route::post('/send-message',  'App\Http\Controllers\Account\ChatController@sendMessage');
        Route::get('/load-chat/{id}',  'App\Http\Controllers\Account\ChatController@loadChat');
        Route::get('/load-chat-ajax/{id}',  'App\Http\Controllers\Account\ChatController@loadChatAjx');
    });


    Route::middleware(['role.admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/',                         'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
        Route::get('/booking',                  'App\Http\Controllers\Admin\BookingController@index')->name('booking');
        Route::get('/booking/datatable',        'App\Http\Controllers\Admin\BookingController@datatable')->name('booking.datatable');
        Route::post('/booking/update/{id}',     'App\Http\Controllers\Admin\BookingController@update')->name('booking.update');
        Route::delete('/booking/delete/{id}',   'App\Http\Controllers\Admin\BookingController@delete')->name('booking.delete');

        Route::get('/reviews',                  'App\Http\Controllers\Admin\ReviewsController@index')->name('reviews');
        Route::get('/reviews/edit/{id}',        'App\Http\Controllers\Admin\ReviewsController@edit')->name('reviews.edit');
        Route::get('/reviews/datatable',        'App\Http\Controllers\Admin\ReviewsController@datatable')->name('reviews.datatable');
        Route::post('/reviews/update/{id}',     'App\Http\Controllers\Admin\ReviewsController@update')->name('reviews.update');
        Route::delete('/reviews/delete/{id}',   'App\Http\Controllers\Admin\ReviewsController@delete')->name('reviews.delete');

        Route::get('/users',                    'App\Http\Controllers\Admin\UserController@index')->name('users');
        Route::get('/users/datatable',          'App\Http\Controllers\Admin\UserController@datatable')->name('users.datatable');
        Route::get('/users/edit/{id}',          'App\Http\Controllers\Admin\UserController@edit')->name('users.edit');
        Route::post('/users/update/{id}',       'App\Http\Controllers\Admin\UserController@update')->name('users.update');

        Route::get('/testimonials',                'App\Http\Controllers\Admin\TestimonialController@index')->name('testimonials');
        Route::get('/testimonials/edit/{id}',      'App\Http\Controllers\Admin\TestimonialController@edit')->name('testimonials.edit');
        Route::post('/testimonials/update/{id}',   'App\Http\Controllers\Admin\TestimonialController@update')->name('testimonials.update');
        Route::delete('/testimonials/delete/{id}', 'App\Http\Controllers\Admin\TestimonialController@delete')->name('testimonials.delete');

        Route::get('/transactions',                'App\Http\Controllers\Admin\TransactionController@index')->name('transactions');

        Route::get('/billing',                    'App\Http\Controllers\Admin\BillingController@index')->name('billing');
        Route::get('/billing/show/{id}',          'App\Http\Controllers\Admin\BillingController@show')->name('billing.show');
        Route::get('/billing/plan/edit/{plan_id}/feature/{feature_id}', 'App\Http\Controllers\Admin\BillingController@editFeature')->name('billing.edit.feature');
        Route::post('/billing/plan/update/{plan_id}/feature/{feature_id}', 'App\Http\Controllers\Admin\BillingController@updateFeature')->name('billing.update.feature');
        Route::delete('/billing/feature/delete/{id}', 'App\Http\Controllers\Admin\BillingController@deleteFeature')->name('billing.feature.delete');

        Route::get('/documents',                'App\Http\Controllers\Admin\DocumentController@index')->name('documents');
        Route::get('/documents/edit/{id}',      'App\Http\Controllers\Admin\DocumentController@edit')->name('documents.edit');
        Route::post('/documents/update/{id}',   'App\Http\Controllers\Admin\DocumentController@update')->name('documents.update');
        Route::delete('/documents/delete/{id}', 'App\Http\Controllers\Admin\DocumentController@delete')->name('documents.delete');
    });
});
