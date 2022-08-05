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

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
use Laravel\Socialite\Facades\Socialite;

use Modules\Admin\Entities\AdminDetail;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\SeoController;
use Modules\Admin\Http\Controllers\SiteConfigController;
use Modules\Admin\Http\Controllers\SocialLoginController;
use Modules\Admin\Http\Middleware\AdminAuthMiddleware;

Route::middleware(['web'])->as('admin.')->group(function () {


    Route::prefix('seo')->as('seo.')->group(function () {
        Route::get('/add', [SeoController::class, 'getAddSeoPage'])->name('getAddSeoPage');
        Route::post('/add', [SeoController::class, 'addSeoForStatic'])->name('addSeoForStatic');

    });

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/generate-sitemap', function () {
        Artisan::call("sitemap:generate");
        return back();
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    });

    Route::post('/{parent}/{type}/seo/add-edit',[SeoController::class ,'addEditSeo']);

    Route::prefix('system-config')->as('system-config.')->middleware("can:Site Config")->group(function () {

        Route::get('index/{page?}', [SiteConfigController::class, 'index'])->name('getSiteConfig');

        Route::post('home-image/add-edit', [SiteConfigController::class, 'addHomeImage'])->name("addHomeImage");

        Route::post('add-edit', [SiteConfigController::class, 'addEditBasicConfig'])->name("addEditBasicConfig");
    });
});

Route::prefix('auth')->as('admin.auth.')->group(function () {

    Route::get('/verify-email', [AdminController::class, 'getVerifyMessage'])->name('getVerifyMessage');


    Route::get('/verify/email/{user:email}', [AdminController::class, 'verifyEmail'])->name('verifyEmail')->middleware('signed');


    Route::get('/login', [AdminController::class, 'getLogin'])->name('login');

    Route::get('/register', [AdminController::class, 'getRegister'])->name('register');


    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::post('/register/add-edit', [AdminController::class, 'postRegister'])->name('postRegister');

    Route::post('/login', [AdminController::class, 'postLogin'])->name('postLogin');

    Route::get('/changeStatus/{id}', [AdminController::class, 'changeStatus'])->name('userChangeStatus');

    Route::get('/forgot-password', [AdminController::class, 'getForgotPassword'])->name('getForgotPassword');

    Route::post('/forgot-password', [AdminController::class, 'postForgotPassword'])->name('postForgotPassword');

    Route::get('/verify/forgot-password/{user:email}', [AdminController::class, 'verifyForgotPassword'])->name('verifyForgotPassword')->middleware('signed');
    Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('resetPassword');




    Route::get('/facebook/redirect', function () {
        return Socialite::driver('facebook')->redirect();
    })->name('facebook-login');

    Route::get('/facebook/callback', [SocialLoginController::class, 'handleCallback'])->name('facebook-redirect');
});
