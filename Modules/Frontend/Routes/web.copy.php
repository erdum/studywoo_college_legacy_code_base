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


Route::get('/', 'FrontendController@index');

use Modules\Frontend\Http\Controllers\FrontendController;
use Modules\Frontend\Http\Controllers\SiteMapXMLController;
use App\Http\Controllers\BlogController;

Route::get('/blog/{slug?}', [BlogController::class, 'display']);

Route::get("review/demo",function(){
    return view("frontend::pages.review.single");
});

Route::get("listing/{filter1?}/{filter2?}/{filter3?}",[FrontendController::class ,'filterCollege'])->name("filterCollege");

Route::get('/', [FrontendController::class, 'index'])->name("homePage");

Route::get('/college-university/{college:slug?}/{page?}', [FrontendController::class, 'getDetailPage'])->name("collegeDetail");

Route::get("/register", [FrontendController::class, "register"])->name("register");

Route::get("/login", [FrontendController::class, "login"])->name("login");

Route::get("/otp-verification", [FrontendController::class, "getOtp"])->name("otp");

Route::post("filter-list", [FrontendController::class, 'filterList'])->name('filterList');

Route::get('/author/{author:username}',[FrontendController::class , "getAuthor"])->name("getAuthor");

Route::get("/reviews/{review:slug}",[FrontendController::class ,'singleReview'])->name("singleReview");

Route::post('/search_list',[FrontendController::class ,'search_list'])->name("search.list");

Route::post('/search_trend',[FrontendController::class ,'search_trend'])->name("search.trend");

Route::get('/sitemap.xml',[SiteMapXMLController::class,'index']);

Route::get('/sitemap-daily.xml',[SiteMapXMLController::class,'sitemap_daily']);

Route::get('/sitemap-weekly.xml',[SiteMapXMLController::class,'sitemap_weekly']);

Route::get('/sitemap-monthly.xml',[SiteMapXMLController::class,'sitemap_monthly']);