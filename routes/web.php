<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::view('/','user.index')->name('user.index');
Route::view('/about','user.about')->name('user.about');
Route::get('/section/{id}', [UserController::class, 'view_section'])->name('user.section');
Route::get('/theme/{theme_id}', [UserController::class, 'show_theme'])->name('user.theme');

Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.login')->name("admin.login");
    Route::post('login', [AdminController::class, 'auth'])->name('admin.auth');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::view('profile','admin.profile')->name('admin.profile');
    Route::post('profile',[AdminController::class, 'update_password'])->name('admin.password.update');

    Route::get('section/{id}', [AdminController::class, 'section'])->name('admin.view.section');
});
