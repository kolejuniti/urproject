<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    if (auth()->check()) {
        switch (auth()->user()->type) {
            case 'user':
                return redirect('/user/dashboard');
            case 'advisor':
                return redirect('/advisor/dashboard');
            case 'admin':
                return redirect('/admin/dashboard');
        }
    }

    $ref = $request->query('ref');
    $source = $request->query('source');
    return view('welcome', compact('ref', 'source')); // Or any other public view
});

// Route::get('/example', function () {
//     return view('example');
// });

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
    Route::post('/admin/application/detail', [AdminController::class, 'applicationDetail'])->name('admin.application.detail');
    Route::put('/admin/application/{id}', [AdminController::class, 'update'])->name('admin.application.update');
    Route::get('/admin/userlist', [AdminController::class, 'userlist'])->name('admin.userlist');
    Route::post('/admin/userlist/detail', [AdminController::class, 'userDetail'])->name('admin.userlist.detail');
    Route::put('/admin/userlist/{id}', [AdminController::class, 'updateUser'])->name('admin.userlist.update');
    Route::get('/admin/studentlist', [AdminController::class, 'studentlist'])->name('admin.studentlist');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/update/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/admin/update/password', [AdminController::class, 'password'])->name('admin.profile.password');
    Route::get('/admin/summary', [AdminController::class, 'summary'])->name('admin.summary');
});

// advisor route
Route::middleware(['auth', 'user-access:advisor'])->group(function() {
    Route::get('/advisor/dashboard', [AdvisorController::class, 'dashboard'])->name('advisor.dashboard');
    Route::get('/advisor/application', [AdvisorController::class, 'applications'])->name('advisor.application');
    Route::post('/advisor/application/detail', [AdvisorController::class, 'applicationDetail'])->name('advisor.application.detail');
    Route::put('/advisor/application/{id}', [AdvisorController::class, 'update'])->name('advisor.application.update');
    Route::get('/advisor/profile', [AdvisorController::class, 'profile'])->name('advisor.profile');
    Route::put('/advisor/update/profile', [AdvisorController::class, 'updateProfile'])->name('advisor.profile.update');
    Route::put('/advisor/update/password', [AdvisorController::class, 'password'])->name('advisor.profile.password');
    Route::get('/advisor/affiliate', [AdvisorController::class, 'affiliate'])->name('advisor.affiliate');
});

// user route
Route::middleware(['auth', 'user-access:user'])->group(function() {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/application', [UserController::class, 'applications'])->name('user.application');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/user/update/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::put('/user/update/password', [UserController::class, 'password'])->name('user.profile.password');
    Route::get('/user/affiliate', [UserController::class, 'affiliate'])->name('user.affiliate');
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
