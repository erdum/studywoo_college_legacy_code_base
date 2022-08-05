<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Admin Panel Controllers
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AdminsRolesController;
use App\Http\Controllers\BlogCategoriesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\PageListController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CollegeSubpagesController;
use App\Http\Controllers\UsersProfileController;
use App\Http\Controllers\LogosController;
use App\Http\Controllers\ApplyNowController;

// Admin Panel Data Controllers
use App\Http\Controllers\DataStateController;
use App\Http\Controllers\DataCityController;
use App\Http\Controllers\DataCourseController;
use App\Http\Controllers\DataExamController;
use App\Http\Controllers\DataAffiliatedController;
use App\Http\Controllers\DataStreamController;
use App\Http\Controllers\DataProgramTypeController;
use App\Http\Controllers\DataCollegeTypeController;
use App\Http\Controllers\DataCourseTypeController;
use App\Http\Controllers\PermissionController;

// Search Controller
use App\Http\Controllers\SearchController;

// File Upload Controller
use App\Http\Controllers\FileUploadController;

// Permission Middleware
use App\Http\Middleware\VerifyPermission;

// SocialMediaAuthController
use App\Http\Controllers\SocialMediaAuthController;



// Social Media Login Route
Route::get('auth/{provider}', [SocialMediaAuthController::class, 'handleAuth'])->name('socialLogin');
Route::get('auth/{provider}/callback', [SocialMediaAuthController::class, 'callback']);

Route::post('register', [AdminsController::class, 'register'])->name('apiRegister');
Route::post('login', [AdminsController::class, 'login'])->name('apiLogin');

Route::post('comment', [CommentsController::class, 'commentFromPublic'])->name('publicComment');
Route::post('review', [ReviewsController::class, 'reviewFromPublic'])->name('publicReview');

// Publically available data lists and Routes
Route::get('permissions-list', [PermissionController::class, 'list']);
Route::get('users-list', [AdminsController::class, 'list']);
Route::get('roles-list', [AdminsRolesController::class, 'list']);
Route::get('page-list', [PageListController::class, 'list']);
Route::get('state-list', [CollegeController::class, 'state_list']);
Route::get('city-list', [CollegeController::class, 'city_list']);
Route::get('college-type-list', [CollegeController::class, 'college_type_list']);
Route::get('affiliated-list', [CollegeController::class, 'affiliated_list']);
Route::get('streams-list', [CollegeController::class, 'stream_list']);
Route::get('program-type-list', [CollegeController::class, 'program_type_list']);
Route::get('course-type-list', [CollegeController::class, 'course_type_list']);
Route::get('entrance-exam-list', [CollegeController::class, 'entrance_exam_list']);
Route::get('courses-list', [CollegeController::class, 'courses_list']);

// Search Route for Frontend
Route::post('search', [SearchController::class, 'search']);


// Main API Routes
Route::middleware(['auth:sanctum', VerifyPermission::class])->group(function() {
    
    Route::prefix('managment')->group(function() {
        
        // Admins Roles
        Route::get('roles', [AdminsRolesController::class, 'index']);
        Route::post('roles', [AdminsRolesController::class, 'create']);
        Route::put('roles', [AdminsRolesController::class, 'update']);
        Route::delete('roles', [AdminsRolesController::class, 'delete']);
        
        // Users
        Route::get('users', [AdminsController::class, 'index']);
        Route::post('users', [AdminsController::class, 'create']);
        Route::put('users', [AdminsController::class, 'update']);
        Route::delete('users', [AdminsController::class, 'delete']);
        
        // Comments
        Route::get('comments', [CommentsController::class, 'index']);
        // Route::post('comments', [CommentsController::class, 'create']);
        Route::put('comments', [CommentsController::class, 'update']);
        Route::delete('comments', [CommentsController::class, 'delete']);
        
        // Faqs
        Route::get('faq', [FaqController::class, 'index']);
        Route::post('faq', [FaqController::class, 'create']);
        Route::put('faq', [FaqController::class, 'update']);
        Route::delete('faq', [FaqController::class, 'delete']);
        
        // Reviews
        Route::get('reviews', [ReviewsController::class, 'index']);
        Route::post('reviews', [ReviewsController::class, 'create']);
        Route::put('reviews', [ReviewsController::class, 'update']);
        Route::delete('reviews', [ReviewsController::class, 'delete']);
        
        // Users Profile
        Route::get('users-profile', [UsersProfileController::class, 'index']);
        Route::put('users-profile', [UsersProfileController::class, 'update']);
        Route::post('user-basic-data', [UsersProfileController::class, 'save_basic_data'])->name('userBasicData');
        Route::post('user-educational-data', [UsersProfileController::class, 'save_educational_data'])->name('userEduData');
        
        // Profile
        Route::get('user-profile', [UsersProfileController::class, 'owner_profile'])->withoutMiddleware([VerifyPermission::class]);
        Route::put('user-profile', [UsersProfileController::class, 'update_owner_profile'])->withoutMiddleware([VerifyPermission::class]);
        
        // Logos
        Route::get('logos', [LogosController::class, 'index']);
        Route::put('logos', [LogosController::class, 'update']);
        
        // Applications
        Route::get('applications', [ApplyNowController::class, 'get']); 
        Route::delete('applications', [ApplyNowController::class, 'delete']);
        
    });
    
    Route::prefix('blog')->group(function() {
        
        // Blogs
        Route::get('/', [BlogController::class, 'index']);
        Route::post('/', [BlogController::class, 'create']);
        Route::put('/', [BlogController::class, 'update']);
        Route::delete('/', [BlogController::class, 'delete']);
        
    });
    
    Route::prefix('colleges')->group(function() {
        
        //Colleges
        Route::get('/', [CollegeController::class, 'index'])->withoutMiddleware([VerifyPermission::class]);
        Route::post('/', [CollegeController::class, 'create']);
        Route::put('/', [CollegeController::class, 'update']);
        
        // Subpages
        Route::get('/subpage', [CollegeSubpagesController::class, 'index']);
        Route::post('/subpage', [CollegeSubpagesController::class, 'create']);
        Route::put('/subpage', [CollegeSubpagesController::class, 'update']);
        Route::delete('/subpage', [CollegeSubpagesController::class, 'delete']);
        
    });
    
    Route::prefix('site')->group(function() {
        
        // Seo Settings For Page
        Route::get('seo', [SeoController::class, 'index']);
        Route::post('seo', [SeoController::class, 'create']);
        Route::put('seo', [SeoController::class, 'update']);
        Route::delete('seo', [SeoController::class, 'delete']);
        
        // Site Setting
        Route::post('/change-images', [SiteSettingController::class, 'changeImages']);
        
    });
    
    Route::prefix('data')->group(function() {
        
        // State
        Route::get('/state', [DataStateController::class, 'index']);
        Route::post('/state', [DataStateController::class, 'create']);
        Route::put('/state', [DataStateController::class, 'update']);
        Route::delete('/state', [DataStateController::class, 'delete']);
        
        // City
        Route::get('/city', [DataCityController::class, 'index']);
        Route::post('/city', [DataCityController::class, 'create']);
        Route::put('/city', [DataCityController::class, 'update']);
        Route::delete('/city', [DataCityController::class, 'delete']);
        
        // Course
        Route::get('/course', [DataCourseController::class, 'index']);
        Route::post('/course', [DataCourseController::class, 'create']);
        Route::put('/course', [DataCourseController::class, 'update']);
        Route::delete('/course', [DataCourseController::class, 'delete']);
        
        // Exam
        Route::get('/exam', [DataExamController::class, 'index']);
        Route::post('/exam', [DataExamController::class, 'create']);
        Route::put('/exam', [DataExamController::class, 'update']);
        Route::delete('/exam', [DataExamController::class, 'delete']);
        
        // Affiliated
        Route::get('/affiliated', [DataAffiliatedController::class, 'index']);
        Route::post('/affiliated', [DataAffiliatedController::class, 'create']);
        Route::put('/affiliated', [DataAffiliatedController::class, 'update']);
        Route::delete('/affiliated', [DataAffiliatedController::class, 'delete']);
        
        // Stream
        Route::get('/stream', [DataStreamController::class, 'index']);
        Route::post('/stream', [DataStreamController::class, 'create']);
        Route::put('/stream', [DataStreamController::class, 'update']);
        Route::delete('/stream', [DataStreamController::class, 'delete']);
        
        // Program Type
        Route::get('/program-type', [DataProgramTypeController::class, 'index']);
        Route::post('/program-type', [DataProgramTypeController::class, 'create']);
        Route::put('/program-type', [DataProgramTypeController::class, 'update']);
        Route::delete('/program-type', [DataProgramTypeController::class, 'delete']);
        
        // College Type
        Route::get('/college-type', [DataCollegeTypeController::class, 'index']);
        Route::post('/college-type', [DataCollegeTypeController::class, 'create']);
        Route::put('/college-type', [DataCollegeTypeController::class, 'update']);
        Route::delete('/college-type', [DataCollegeTypeController::class, 'delete']);
        
        // Course Type
        Route::get('/course-type', [DataCourseTypeController::class, 'index']);
        Route::post('/course-type', [DataCourseTypeController::class, 'create']);
        Route::put('/course-type', [DataCourseTypeController::class, 'update']);
        Route::delete('/course-type', [DataCourseTypeController::class, 'delete']);
        
    });
    
});

// Logout
Route::get('logout', [AdminsController::class, 'logout'])->middleware(['auth:sanctum'])->name('logout');

// File Upload
Route::post('file', [FileUploadController::class, 'upload'])->middleware(['auth:sanctum']);
Route::post('pilot_upload', [FileUploadController::class, 'pilot_upload'])->middleware(['auth:sanctum']);
