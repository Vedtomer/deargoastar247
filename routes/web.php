<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DrawController;


use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/rashi', [HomeController::class, 'Rashi'])->name('Rashi');
Route::get('/login', [HomeController::class, 'Login'])->name('website.login');
Route::get('/month-result', [HomeController::class, 'MonthResult'])->name('website.month.result');



Route::get('/get-draws', [HomeController::class, 'getDrawsByDate']);
Route::get('/get-monthly-draws', [HomeController::class, 'getMonthlyDraws']);

// Route::get('/login', function () {
//     return redirect('/admin/login');
// });
Route::get('/generate-draw', [DrawController::class, 'generateDraw'])->name('generate.draw');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });


    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('login');
    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/profile/edit', [AdminController::class, 'ProfileEdit'])->name('edit.profile');
        Route::post('/profile/update', [AdminController::class, 'ProfileUpdate'])->name('admin.update');
        Route::match(['get', 'post'], '/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::resource('draws', DrawController::class);
    });
});
