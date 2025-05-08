<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DictController;
use App\Http\Controllers\DictSectionController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TopicPdfController;
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

    Route::get('theme-topic/{theme_id}', [TopicPdfController::class, 'show_theme_topics'])->name('theme.topic.view');
    Route::post('add-topic', [TopicPdfController::class, 'new_topic'])->name('admin.topic.add');
    Route::get('delete-topic/{id}', [TopicPdfController::class, 'delete_topic'])->name('admin.topic.delete');

    Route::get('theme-presentation/{theme_id}', [PresentationController::class, 'show_theme_topics'])->name('theme.presentation.view');
    Route::post('add-presentation', [PresentationController::class, 'new_topic'])->name('admin.presentation.add');
    Route::get('delete-presentation/{id}', [PresentationController::class, 'delete_topic'])->name('admin.presentation.delete');

    Route::get('show-section-dict-sections/{section_id}', [DictSectionController::class, 'show'])->name('admin.section.dict.sections');
    Route::post('add-dict-section', [DictSectionController::class, 'new_section'])->name('admin.add.dict.section');
    Route::get('show-section-dicts/{section_id}', [DictController::class, 'show_section_dicts'])->name('admin.theme.dicts');
    Route::get('delete-section-dict/{dict_id}', [DictController::class, 'delete_dict'])->name('admin.delete.dict');
    Route::post('add-dict', [DictController::class, 'new_dict'])->name('admin.add.dict');

    Route::get('show-theme-quizzes/{theme_id}', [QuizController::class, 'show_quizzes'])->name('admin.theme.quizzes');
    Route::get('delete-theme-quiz/{quiz_id}', [QuizController::class, 'delete_quiz'])->name('admin.delete.quiz');
    Route::post('add-quiz', [QuizController::class, 'add_quiz'])->name('admin.add.quiz');
});
