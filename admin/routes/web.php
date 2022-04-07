<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;

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
//error log
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/',[HomeController::class,'HomeIndex'])->middleware('loginCheck');
Route::get('/visitor',[VisitorController::class,'VisitorIndex'])->middleware('loginCheck');

//Admin Service Management

Route::get('/services',[ServiceController::class,'ServiceIndex'])->middleware('loginCheck');
Route::get('/servicesData',[ServiceController::class,'ServiceData'])->middleware('loginCheck');
Route::post('/servicesDelete',[ServiceController::class,'ServiceDelete'])->middleware('loginCheck');
Route::post('/servicesDetails',[ServiceController::class,'getServicesDetails'])->middleware('loginCheck');
Route::post('/ServiceUpdate',[ServiceController::class,'ServiceUpdate'])->middleware('loginCheck');
Route::post('/ServiceAdd',[ServiceController::class,'serviceAdd'])->middleware('loginCheck');

//Admin Course Management

Route::get('/courses',[CoursesController::class,'CoursesIndex'])->middleware('loginCheck');
Route::get('/getcoursesData',[CoursesController::class,'CoursesData'])->middleware('loginCheck');
Route::post('/coursesDelete',[CoursesController::class,'CoursesDelete'])->middleware('loginCheck');
Route::post('/coursesDetails',[CoursesController::class,'getCoursesDetails'])->middleware('loginCheck');
Route::post('/coursesUpdate',[CoursesController::class,'CoursesUpdate'])->middleware('loginCheck');
Route::post('/coursesAdd',[CoursesController::class,'CoursesAdd'])->middleware('loginCheck');


//Admin Project Management

Route::get('/projects',[ProjectController::class,'ProjectsIndex'])->middleware('loginCheck');
Route::get('/getprojectsData',[ProjectController::class,'ProjectsData'])->middleware('loginCheck');
Route::post('/projectsDelete',[ProjectController::class,'ProjectsDelete'])->middleware('loginCheck');
Route::post('/projectsDetails',[ProjectController::class,'getProjectsDetails'])->middleware('loginCheck');
Route::post('/projectsUpdate',[ProjectController::class,'ProjectsUpdate'])->middleware('loginCheck');
Route::post('/projectsAdd',[ProjectController::class,'ProjectAdd'])->middleware('loginCheck');


//Admin Contact Management

Route::get('/contacts',[ContactController::class,'ContactIndex'])->middleware('loginCheck');
Route::get('/getcontactsData',[ContactController::class,'ContactsData'])->middleware('loginCheck');
Route::post('/contactsDelete',[ContactController::class,'ContactDelete'])->middleware('loginCheck');

//Admin Review Management

Route::get('/reviews',[ReviewController::class,'ReviewIndex'])->middleware('loginCheck');
Route::get('/getreviewsdata',[ReviewController::class,'ReviewsData'])->middleware('loginCheck');
Route::post('/addreviewsdata',[ReviewController::class,'ReviewAdd'])->middleware('loginCheck');
Route::post('/getreviewsdetails',[ReviewController::class,'ReviewDetails'])->middleware('loginCheck');
Route::post('/reviewsupdate',[ReviewController::class,'ReviewUpdate'])->middleware('loginCheck');
Route::post('/reviewsdelete',[ReviewController::class,'ReviewDelete'])->middleware('loginCheck');


//Admin login
Route::get('/login',[LoginController::class,'LoginIndex']);
Route::post('/onlogin',[LoginController::class,'onLogin']);
Route::get('/onlogout',[LoginController::class,'onLogout']);

//Admin Photo Gallery Management
Route::get('/photo',[PhotoController::class,'PhotoIndex']);
Route::post('/photoupload',[PhotoController::class,'PhotoUpload']);
