<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
   return abort(404);
});

Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('authenticate')
    ->middleware('throttle:3:1');
Route::post('/logout', [LoginController::class, 'logout']);


Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::get('/anka/{resource}', [ResourceController::class, 'index'])->name('index');
    Route::get('/anka/{resource}/create', [ResourceController::class, 'create'])->name('create');
    Route::get('/anka/{resource}/edit/{id}', [ResourceController::class, 'edit'])->name('edit');
    Route::post('/anka/{resource}/edit/{id}', [ResourceController::class, 'update'])->name('update');
    Route::get('/anka/{resource}/edit/{id}/{lang}', [ResourceController::class, 'translate'])->name('translate');
    Route::post('/anka/{resource}/edit/{id}/{lang}', [ResourceController::class, 'translateStore'])->name('translateStore');
    Route::post('/anka/{resource}/create', [ResourceController::class, 'store']);
    Route::delete('/anka/{resource}/delete/{id}', [ResourceController::class, 'destroy'])->name('destroy');

    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('editProfile');
    Route::post('/edit-profile', [ProfileController::class, 'update']);
});



