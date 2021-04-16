<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ExpertController;
use Illuminate\Support\Facades\Route;
use App\Models\Expert;

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
// guest middleware
Route::middleware(['guest'])->group(function () {
    Route::view('/', 'welcome')->name('welcome');
});

// auth and verified middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        $experts = Expert::all();
        $experts_count = Expert::count();

        return view('dashboard', compact('experts', 'experts_count'));
    })->name('dashboard');

    // about
    Route::get('/about', function () {
        return view('about');
    })->name('about');

    // list article for user
    Route::get('/articles-mental-disorder', [ArticleController::class, 'list'])->name('articles.list');
    Route::get('/articles-mental-disorder/{article:slug}', [ArticleController::class, 'slug'])->name('articles.slug');

    // admin and expert middleware
    Route::middleware(['admin_and_expert'])->group(function () {
        // user consultation history
        Route::get('/user-consultation-history', function () {
            return view('user-consultation-history');
        })->name('userConsultationHistory');

        // manage articles
        Route::resource('articles', ArticleController::class)->except('show', 'destroy');
    });

    // admin only middleware
    Route::middleware(['admin'])->group(function () {
        // manage experts
        Route::resource('experts', ExpertController::class);
    });
});
