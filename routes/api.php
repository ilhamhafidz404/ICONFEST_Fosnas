<?php

use App\Http\Controllers\CountController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
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


Route::apiResource('users', UserController::class);
Route::apiResource('schools', SchoolController::class);

Route::get("countUser", [CountController::class, "users"]);
Route::get("countSchool", [CountController::class, "schools"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
