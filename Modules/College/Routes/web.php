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

use Modules\College\Entities\State;

use Illuminate\Support\Str;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\City;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeDetails;
use Modules\College\Entities\CollegeImage;
use Modules\College\Entities\CollegeSubpage;
use Modules\College\Entities\Comment;
use Modules\College\Entities\Course;
use Modules\College\Entities\EntranceExam;
use Modules\College\Entities\Image;
use Modules\College\Entities\Review;

// Route::prefix('college')->as('admin.college.')->group(function () {

//     Route::get('/', 'CollegeController@index');
//     Route::get('add-edit', 'CollegeController@getAddEditForm')->name('getAddEditForm');
//      Route::get('edit/{id}', 'CollegeController@getEditForm')->name('addEdit');
//     Route::post('add-edit', 'CollegeController@postAddEdit')->name("postAddEdit");
//     Route::post('edit', 'CollegeController@postEdit')->name("editCollege");
//     Route::get('destroy/{college}', 'CollegeController@delete')->name("deleteCollege");
//     Route::get('list', 'CollegeController@index')->name('list');
//     Route::get('/image/list/{college}', 'CollegeController@imageList')->name("image.list");
//     Route::get('/image/delete/{image}', 'CollegeController@deleteImage')->name("image.delete");
//     Route::post('/addImage/add-edit', 'CollegeController@addImage')->name("addImage");

//     Route::prefix('college-course/{college}')->as('course.')->group(function () {
//         Route::get('/', 'CollegeCourseController@index')->name('list');
//         Route::post('/add-edit', 'CollegeCourseController@store')->name('store');
//     });

//     Route::prefix('college-course/{college_course}')->as('course.')->group(function () {
//         Route::get('/delete', 'CollegeCourseController@delete')->name('delete');

//     });

//     Route::prefix('college-video/{college}')->as('video.')->group(function () {
//         Route::get('/', 'CollegeVideoController@index')->name('list');
//         Route::post('/add-edit', 'CollegeVideoController@store')->name('store');
//     });

//     Route::prefix('college-video/{college_course}')->as('video.')->group(function () {
//         Route::get('/delete', 'CollegeVideoController@delete')->name('delete');

//     });

//     Route::prefix('college-faq/{college}')->as('faq.')->group(function () {
//         Route::get('/', 'CollegeFaqController@index')->name('list');

//         Route::get('/add','CollegeFaqController@getAddFAQPage')->name('getAddFAQPage');

//         Route::post('/add-edit', 'CollegeFaqController@store')->name('store');
//     });

//     Route::prefix('college-faq/{college_faq}')->as('faq.')->group(function () {
//         Route::get('/delete', 'CollegeFaqController@delete')->name('delete');


//     });

//     Route::prefix('college-subpage/{college}')->as('subpage.')->group(function () {
//         Route::get('/', 'CollegeSubPageController@index')->name('list');
//         Route::get('/add-edit', 'CollegeSubPageController@create')->name('add-edit');
//         Route::post('/add-edit', 'CollegeSubPageController@store')->name('store');
//         Route::get('/edit', 'CollegeSubPageController@editSubpage')->name('edit');
//         Route::post('/{subpage}/edit/add-edit','CollegeSubPageController@updateSubpage')->name('update');

//     });

//     Route::prefix('college-subpage/{subpage}')->as('subpage.')->group(function () {
//          Route::get('/edit', 'CollegeSubPageController@editSubpage')->name('editSubpageDetail');
//         // Route::get('/update', 'CollegeSubPageController@editSubpage')->name('update');
//         Route::get('/delete', 'CollegeSubPageController@deleteSubpage')->name('delete');
//       //  Route::post('/seo/add-edit', 'CollegeSubPageController@addSeo')->name('addSeo');
//     });
// });



// Route::prefix('state')->as('admin.state.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'StateController@index')->name('list');

//     Route::post('/add-edit/{state?}', 'StateController@store')->name('store');

//     Route::get('/change-status/{state}', 'StateController@changeStatus')->name('change_status');

//     Route::get('/destroy/{id}', 'StateController@destroy')->name('delete');
// });

// Route::prefix('city')->as('admin.city.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'CityController@index')->name('list');

//     Route::post('/add-edit/{city?}', 'CityController@store')->name('store');

//     Route::get('/destroy/{id}', 'CityController@destroy')->name('delete');
// });

// Route::prefix('course')->as('admin.course.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'CourseController@index')->name('list');

//     Route::post('/add-edit/{course?}', 'CourseController@store')->name('store');

//     Route::get('/destroy/{id}', 'CourseController@destroy')->name('delete');
// });

// Route::prefix('entranceExam')->as('admin.entranceExam.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'EntranceExamController@index')->name('list');

//     Route::post('/add-edit/{entranceExam?}', 'EntranceExamController@store')->name('store');

//     Route::get('/destroy/{id}', 'EntranceExamController@destroy')->name('delete');
// });

// Route::prefix('affiliated')->as('admin.affiliated.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'AffiliatedController@index')->name('list');

//     Route::post('/add-edit/{affiliated?}', 'AffiliatedController@store')->name('store');

//     Route::get('/destroy/{id}', 'AffiliatedController@destroy')->name('delete');
// });

// Route::prefix('stream')->as('admin.stream.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'StreamController@index')->name('list');

//     Route::post('/add-edit/{stream?}', 'StreamController@store')->name('store');

//     Route::get('/destroy/{id}', 'StreamController@destroy')->name('delete');
// });

// Route::prefix('program')->as('admin.program.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'ProgramController@index')->name('list');

//     Route::post('/add-edit/{program?}', 'ProgramController@store')->name('store');

//     Route::get('/destroy/{id}', 'ProgramController@destroy')->name('delete');
// });

// Route::prefix('courseType')->as('admin.courseType.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'CourseTypeController@index')->name('list');

//     Route::post('/add-edit/{courseType?}', 'CourseTypeController@store')->name('store');

//     Route::get('/destroy/{id}', 'CourseTypeController@destroy')->name('delete');
// });

// Route::prefix('collegeType')->as('admin.collegeType.')->middleware("can:Basic Setup")->group(function () {
//     Route::get('/', 'CollegeTypeController@index')->name('list');

//     Route::post('/add-edit/{collegeType?}', 'CollegeTypeController@store')->name('store');

//     Route::get('/destroy/{id}', 'CollegeTypeController@destroy')->name('delete');
// });

// Route::prefix('role')->as('admin.role.')->middleware("can:Manage User")->group(function () {
//     Route::get('/', 'RoleController@index')->name('list');

//     Route::post('/add-edit/{role?}', 'RoleController@store')->name('store');

//     Route::get('/destroy/{id}', 'RoleController@destroy')->name('delete');
// });

// Route::prefix('auth')->as('admin.user.')->middleware("can:Manage User")->group(function () {
//     Route::get('/', 'UserController@index')->name('list');

//     Route::get('/profile', 'UserController@viewProfile')->name('viewProfile');

//     Route::post('/add-edit/{user?}', 'UserController@store')->name('store');

//     Route::get('/destroy/{id}', 'UserController@destroy')->name('delete');

//     Route::post('/saveProfile/add-edit', 'UserController@saveProfile')->name('saveProfile');
// });

// Route::prefix('college')->as('admin.college.')->middleware("can:Manage User")->group(function () {
//     Route::get('/applications','ApplicationController@index')->name('applications');
// });



// Route::post('/update_user_status','UserController@update_user_status')->name('user_status');
// Route::post('/change_user_password','UserController@change_user_password')->name('user_password');
