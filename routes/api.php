<?php

use App\Http\Controllers\arsip_main_controller;
use App\Http\Controllers\kategori_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::delete('destroyArsip/{id}', [arsip_main_controller::class, 'destroy']);
Route::delete('destroyKategori/{id}', [kategori_controller::class, 'destroy']);