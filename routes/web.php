<?php

use App\Http\Controllers\AnggotasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

Route::get('/cekobject', [AnggotasController::class, 'cekObject'],);
Route::get('/insert', [AnggotasController::class, 'insert'],);
Route::get('/update', [AnggotasController::class, 'update'],);
Route::get('/delete', [AnggotasController::class, 'delete'],);
Route::get('/all', [AnggotasController::class, 'all'],);
Route::get('/find', [AnggotasController::class, 'find'],);
Route::get('/getwhere', [AnggotasController::class, 'getWhere'],);