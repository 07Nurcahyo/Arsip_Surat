<?php

use App\Http\Controllers\arsip_main_controller;
use App\Http\Controllers\kategori_controller;
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


Route::get('/', [arsip_main_controller::class, 'index']);

Route::group(['prefix' => 'arsip'], function () {
    Route::get('/', [arsip_main_controller::class, 'index']);
    Route::post('/list', [arsip_main_controller::class, 'list']);
    Route::get('/create', [arsip_main_controller::class, 'create']);
    Route::post('/', [arsip_main_controller::class, 'store']);
    Route::get('/{id}', [arsip_main_controller::class, 'show']);
    Route::get('/{id}/edit', [arsip_main_controller::class, 'edit']);
    Route::put('/{id}', [arsip_main_controller::class, 'update']);
    Route::delete('/{id}', [arsip_main_controller::class, 'destroy']);
    Route::get('/{id}/download', [arsip_main_controller::class, 'download'])->name('arsip.download');
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [kategori_controller::class, 'index']);
    Route::post('/list', [kategori_controller::class, 'list']);
    Route::get('/create', [kategori_controller::class, 'create']);
    Route::post('/', [kategori_controller::class, 'store']);
    Route::get('/{id}', [kategori_controller::class, 'show']);
    Route::get('/{id}/edit', [kategori_controller::class, 'edit']);
    Route::put('/{id}', [kategori_controller::class, 'update']);
    Route::delete('/{id}', [kategori_controller::class, 'destroy']);
});

Route::get('/about', [arsip_main_controller::class, 'about']);