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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("categories", [\App\Http\Controllers\API\CategoryController::class, "getAll"]);
Route::get("categories/{id}", [\App\Http\Controllers\API\CategoryController::class, "getById"]);
Route::post("categories/create", [\App\Http\Controllers\API\CategoryController::class, "create"]);
Route::delete("categories/delete/{id}", [\App\Http\Controllers\API\CategoryController::class, "delete"]);
Route::post("categories/edit/{id}", [\App\Http\Controllers\API\CategoryController::class, "edit"]);

Route::post("register", [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post("product", [\App\Http\Controllers\API\ProductController::class, 'create']);
