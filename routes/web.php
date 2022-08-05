<?php

use Modules\Frontend\Http\Controllers\FrontendController;
use Modules\Frontend\Http\Controllers\SiteMapXMLController;

// Blog Controller
use App\Http\Controllers\BlogController;

// CollegeController
use App\Http\Controllers\CollegeController;

// ApplyNowController
use App\Http\Controllers\ApplyNowController;

// ProfileController
use Modules\Customer\Http\Controllers\ProfileController;

// Sitemap Controller
use App\Http\Controllers\SitemapController;

use App\Http\Middleware\VerifyWebRouteWithCookie;

Route::get('/', [FrontendController::class, 'index'])->name("homePage");

Route::get('/blog/{blog}', [BlogController::class, 'display']);

Route::get('/listing/{slug?}',[CollegeController::class, 'display'])->where('slug', '.*')->name('listingPage');

Route::get('/author/{author}', [FrontendController::class, 'getAuthor'])->name('author-profile');

Route::get('/apply/{college}',[ApplyNowController::class, 'applyNow'])->name('postApply');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware([VerifyWebRouteWithCookie::class]);

Route::get('/login', [FrontendController::class, 'login'])->name('login');

Route::get('/sitemap-daily.xml', [SitemapController::class, 'daily']);
Route::get('/sitemap-weekly.xml', [SitemapController::class, 'weekly']);
Route::get('/sitemap-monthly.xml', [SitemapController::class, 'monthly']);
Route::get('/sitemap-yearly.xml', [SitemapController::class, 'yearly']);

// Wildcard Route for React Admin Panel
Route::view('/admin/{path?}', 'admin_panel');

Route::get('/{college:slug?}/{page?}', [FrontendController::class, 'getDetailPage'])->name("collegeDetail");