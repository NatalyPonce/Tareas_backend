<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/users', [UserController::class, 'store']); //ruta para mostrar los usuarios
    Route::get('/users', [UserController::class, 'index']); //ruta get para meter parametros en la ruta
    Route::get('/users/{user}', [UserController::class, 'show']); //ruta para mostrar un usuario especifico
    Route::put('/users/{user}', [UserController::class,'update']); //ruta para hacerle update a un usuario especifico.
});