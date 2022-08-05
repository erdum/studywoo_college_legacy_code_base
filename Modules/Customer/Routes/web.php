<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Customer\Http\Middleware\CustomerAuthMiddleware;

Route::prefix('customer')->group(function () {

    // Route::get('/profile', 'ProfileController@index')->name('profile');

    // Route::post('/postProfile', 'ProfileController@store')->name('postProfile');

    // Route::post('/postProfileEducationalDetail', 'ProfileController@postProfileEducationalDetail')->name('postProfileEducationalDetail');

    // Route::get('/review', 'ReviewController@index')->name('review');

    // Route::get('/bookmark', 'BookmarkController@index')->name('bookmark');

    // Route::get('/apply/{college}','CustomerController@getApplyNowForm')->name('applyNow');

});

// Route::post('/apply/{college}','CustomerController@applyNow')->name('postApply');

// Route::middleware(CustomerAuthMiddleware::class)->group(function () {

//     Route::get('/leave-review', 'ReviewController@getReviewPage')->name('getReviewPage');

//     Route::post('/saveReview', 'ReviewController@saveReview')->name('saveCustomerReview');

//     Route::post('/saveComment', 'CommentController@store')->name('saveComment');
// });

// Route::post('/verifyOTP', 'CustomerController@verifyOTP')->name('verifyOTP');

// Route::prefix('customer')->group(function () {
//     Route::post('/register', 'CustomerController@register')->name('postRegister');

//     Route::post('/handleLogin', 'CustomerController@postLogin')->name('postLogin');

//     Route::get('/forgot-password', 'CustomerController@getEmailVerify')->name('emailVerify');

//     Route::get('/otp-verification', 'CustomerController@getOtpVerification')->name('otpVerification');

//     Route::get('/change-password', 'CustomerController@getChangePassword')->name('changePassword');

//     Route::post('/forgot-password', 'CustomerController@postEmailVerify')->name('postEmailVerify');

//     Route::post('/otp-verification', 'CustomerController@postOtpVerification')->name('postOtpVerification');

//     Route::post('/change-password', 'CustomerController@postChangePassword')->name('postChangePassword');

//     Route::post('/change-status','CustomerController@reviewStatus')->name('review_status');

//     Route::get('/logout', 'CustomerController@logout')->name('logout');
// });
