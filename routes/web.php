<?php

use App\Http\Controllers\OrderController;
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

Route::get('/', [OrderController::class, 'index'])->name('home');

Route::prefix('order')->group(function () {
    Route::prefix('{order}')->group(function () {
        Route::get('/', [OrderController::class, 'show'])->name('order.show');
        Route::get('/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('/edit', [OrderController::class, 'update'])->name('order.update');
    });
});
