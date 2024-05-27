<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// admin route
Route::middleware(['auth', 'user-access:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'register']);
    Route::get('/admin/application', [AdminController::class, 'applications'])->name('admin.application');
    Route::put('/admin/application/{id}', [AdminController::class, 'update'])->name('admin.application.update');
});

// manager route
Route::middleware(['auth', 'user-access:manager'])->group(function() {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/application', [ManagerController::class, 'applications'])->name('manager.application');
    Route::put('/manager/application/{ic}', [ManagerController::class, 'update'])->name('manager.application.update');
});

// user route
Route::middleware(['auth', 'user-access:user'])->group(function() {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/application', [UserController::class, 'applications'])->name('user.application');
});

Route::prefix('student')->group(function() {
    Route::get('/register', [App\Http\Controllers\StudentController::class, 'index'])->name('student.register');
    Route::post('/register', [App\Http\Controllers\StudentController::class, 'register'])->name('student.register.post');
    Route::get('/confirmation', [App\Http\Controllers\StudentController::class, 'confirmation'])->name('student.confirmation');
    Route::get('/search', [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');
    Route::get('/location/{id}', [App\Http\Controllers\StudentController::class, 'location']);
});
