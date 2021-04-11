<?php

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
Route::middleware(['guest'])->group(function () {
    Route::view('/', 'welcome')->name('welcome');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $experts = Expert::all();
        $experts_count = Expert::count();

        return view('dashboard', compact('experts', 'experts_count'));
    })->name('dashboard');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::middleware(['admin', 'expert'])->group(function () {
        Route::get('/user_consultation_history', function () {
            return view('user-consultation-history');
        })->name('userConsultationHistory');
    });

    Route::middleware(['admin'])->group(function () {
        Route::resource('experts', ExpertController::class);
    });
});
