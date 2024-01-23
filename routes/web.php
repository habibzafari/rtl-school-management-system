<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authlogin']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);


Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //class urls

    Route::get('admin/class/list', [ClassController::class, 'classList']);
    Route::get('admin/class/add', [ClassController::class, 'classAdd']);
    Route::post('admin/class/add', [ClassController::class, 'classInsert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'classEdit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'classUpdate']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'classDelete']);

    //subject urls

    Route::get('admin/subject/list', [SubjectController::class, 'subjectList']);
    // Route::get('admin/subject/add', [SubjectController::class, 'subjectAdd']);
    // Route::post('admin/subject/add', [SubjectController::class, 'subjectInsert']);
    // Route::get('admin/subject/edit/{id}', [SubjectController::class, 'subjectEdit']);
    // Route::post('admin/subject/edit/{id}', [SubjectController::class, 'subjectUpdate']);
    // Route::get('admin/subject/delete/{id}', [SubjectController::class, 'subjectDelete']);
    
});
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
});
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
});
