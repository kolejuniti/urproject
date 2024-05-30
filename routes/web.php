<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('affiliate')->group(function() {
    Route::get('/', [RegisterController::class, 'about'])->name('about');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// admin route
Route::middleware(['auth', 'user-access:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'register']);
    Route::get('/admin/application', [AdminController::class, 'applications'])->name('admin.application');
    Route::put('/admin/application/{id}', [AdminController::class, 'update'])->name('admin.application.update');
    Route::get('/admin/userlist', [AdminController::class, 'userlist'])->name('admin.userlist');
    Route::get('/admin/studentlist', [AdminController::class, 'studentlist'])->name('admin.studentlist');
});

// advisor route
Route::middleware(['auth', 'user-access:advisor'])->group(function() {
    Route::get('/advisor/dashboard', [AdvisorController::class, 'dashboard'])->name('advisor.dashboard');
    Route::get('/advisor/application', [AdvisorController::class, 'applications'])->name('advisor.application');
    Route::put('/advisor/application/{ic}', [AdvisorController::class, 'update'])->name('advisor.application.update');
});

// user route
Route::middleware(['auth', 'user-access:user'])->group(function() {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/application', [UserController::class, 'applications'])->name('user.application');
});

// student route
Route::prefix('student')->group(function() {
    Route::get('/register', [App\Http\Controllers\StudentController::class, 'index'])->name('student.register');
    Route::post('/register', [App\Http\Controllers\StudentController::class, 'register'])->name('student.register.post');
    Route::get('/confirmation', [App\Http\Controllers\StudentController::class, 'confirmation'])->name('student.confirmation');
    Route::get('/search', [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');
    Route::get('/location/{id}', [App\Http\Controllers\StudentController::class, 'location']);
    Route::get('/offerletter', [App\Http\Controllers\StudentController::class, 'offerletter'])->name('student.offerletter');
    Route::get('/about', [App\Http\Controllers\StudentController::class, 'about'])->name('student.about');
});
