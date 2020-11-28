<?php

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



Route::get('/login', function () {
   return 'login';
});


Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return 'dash';
    });
    Route::get('/{resource}', [ResourceController::class, 'index'])->name('index');
    Route::get('/{resource}/create', [ResourceController::class, 'create'])->name('create');
    Route::get('/{resource}/edit/{id}', [ResourceController::class, 'edit'])->name('edit');
    Route::post('/{resource}/edit/{id}', [ResourceController::class, 'update'])->name('update');
    Route::get('/{resource}/edit/{id}/{lang}', [ResourceController::class, 'translate'])->name('translate');
    Route::post('/{resource}/edit/{id}/{lang}', [ResourceController::class, 'translateStore'])->name('translateStore');
    Route::post('/{resource}/create', [ResourceController::class, 'store']);
    Route::delete('/{resource}/delete/{id}', [ResourceController::class, 'destroy'])->name('destroy');
});



