<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DrawController;


use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/get-draws', [HomeController::class, 'getDrawsByDate']);


Route::get('/login', function () {
    return redirect('/admin/login');
});
Route::get('/generate-draw', [DrawController::class, 'generateDraw'])->name('generate.draw');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });


    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('login');
    Route::middleware([ 'auth'])->group(function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/profile/edit', [AdminController::class, 'ProfileEdit'])->name('edit.profile');
        Route::post('/profile/update', [AdminController::class, 'ProfileUpdate'])->name('admin.update');
        Route::match(['get', 'post'], '/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::resource('draws', DrawController::class);

    });
});
