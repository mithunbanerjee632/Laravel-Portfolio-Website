<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;

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

Route::get('/',[HomeController::class,'HomeIndex']);
Route::get('/visitor',[VisitorController::class,'VisitorIndex']);

//Admin Service Management

Route::get('/services',[ServiceController::class,'ServiceIndex']);
Route::get('/servicesData',[ServiceController::class,'ServiceData']);
Route::post('/servicesDelete',[ServiceController::class,'ServiceDelete']);
Route::post('/servicesDetails',[ServiceController::class,'getServicesDetails']);
Route::post('/ServiceUpdate',[ServiceController::class,'ServiceUpdate']);
Route::post('/ServiceAdd',[ServiceController::class,'serviceAdd']);

//Admin Course Management

Route::get('/courses',[CoursesController::class,'CoursesIndex']);
Route::get('/getcoursesData',[CoursesController::class,'CoursesData']);
Route::post('/coursesDelete',[CoursesController::class,'CoursesDelete']);
Route::post('/coursesDetails',[CoursesController::class,'getCoursesDetails']);
Route::post('/coursesUpdate',[CoursesController::class,'CoursesUpdate']);
Route::post('/coursesAdd',[CoursesController::class,'CoursesAdd']);


//Admin Project Management

Route::get('/projects',[ProjectController::class,'ProjectsIndex']);
Route::get('/getprojectsData',[ProjectController::class,'ProjectsData']);
Route::post('/projectsDelete',[ProjectController::class,'ProjectsDelete']);
Route::post('/projectsDetails',[ProjectController::class,'getProjectsDetails']);
Route::post('/projectsUpdate',[ProjectController::class,'ProjectsUpdate']);
Route::post('/projectsAdd',[ProjectController::class,'ProjectAdd']);

