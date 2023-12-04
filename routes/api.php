<?php

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

Route::post("login", [App\Http\Controllers\AuthController::class, "login"] );
Route::post("me", [App\Http\Controllers\AuthController::class, "me"] );
Route::post("logout", [App\Http\Controllers\AuthController::class, "logout"] );
Route::post("refresh", [App\Http\Controllers\AuthController::class, "refresh"] );

    Route::prefix('user')->group(function () {    
        Route::post("create", [App\Http\Controllers\UserController::class, "store"] );
        Route::post("update", [App\Http\Controllers\UserController::class, "update"] );
        Route::delete("delete", [App\Http\Controllers\UserController::class, "distroy"] );
        Route::get("find", [App\Http\Controllers\UserController::class, "show"] );
        Route::get("findAll", [App\Http\Controllers\UserController::class, "showAll"] );
    });

    Route::prefix('horario')->group(function () {
        Route::post("create", [App\Http\Controllers\HorariosController::class, "store"] );
        Route::get("findAll", [App\Http\Controllers\HorariosController::class, "showAll"] );
    });

    Route::prefix('rotas')->group(function(){
        Route::post("create", [App\Http\Controllers\RotasController::class, "store"] );
        Route::post("update", [App\Http\Controllers\RotasController::class, "update"] );
        Route::delete("delete", [App\Http\Controllers\RotasController::class, "distroy"] );
        Route::get("show/{origem}/{destino}", [App\Http\Controllers\RotasController::class, "show"] );
        Route::get("all", [App\Http\Controllers\RotasController::class, "showAll"]);
        Route::get("find/{id}", [App\Http\Controllers\RotasController::class, "find"]);
    });

    Route::prefix('perfil')->group(function(){
        
    });

    Route::prefix('viagem')->group(function(){
        Route::post("create", [App\Http\Controllers\ViagensController::class, "store"] );
        Route::get("findAll", [App\Http\Controllers\ViagensController::class, "showAll"] );
    });

    Route::prefix('embarque')->group(function(){
        Route::post("create", [App\Http\Controllers\LocalEmbarqueController::class, "store"] ); 
        Route::delete("delete", [App\Http\Controllers\LocalEmbarqueController::class, "distroy"] ); 
        Route::get("findAll", [App\Http\Controllers\LocalEmbarqueController::class, "showAll"] ); 
    });

