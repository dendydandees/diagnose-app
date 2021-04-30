<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SymptomController;
use Illuminate\Support\Facades\Route;
use App\Models\Expert;
use App\Models\Disease;
use App\Models\Symptom;

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
        $experts_count = Expert::count();
        $symptoms_count = Symptom::count();
        $diseases_count = Disease::count();

        return view('dashboard', compact('experts_count', 'symptoms_count', 'diseases_count'));
    })->name('dashboard');

    Route::get('/consult', function() {
        return view('consult/index');
    })->name('consult');

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

        // manage symptoms
        Route::resource('symptoms', SymptomController::class)->only('index');

        // manage diseases
        Route::resource('diseases', DiseaseController::class)->except('show');

        // manage rule
        Route::resource('rules', RuleController::class);
    });

    // admin only middleware
    Route::middleware(['admin'])->group(function () {
        // manage experts
        Route::resource('experts', ExpertController::class);
    });
});
