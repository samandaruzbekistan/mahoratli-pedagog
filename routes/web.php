<?php

use App\Http\Controllers\AdminController;
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

Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.login')->name("admin.login");
    Route::post('login', [AdminController::class, 'auth'])->name('admin.auth');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::view('profile','admin.profile')->name('admin.profile');
    Route::post('profile',[AdminController::class, 'update_password'])->name('admin.password.update');
});
