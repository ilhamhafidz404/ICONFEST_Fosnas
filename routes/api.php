<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\OptionContoller;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
Route::apiResource('articles', ArticleController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('activities', ActivityController::class);

Route::get("countUser", [CountController::class, "users"]);
Route::get("countSchool", [CountController::class, "schools"]);

Route::put("giveschool/{id}", function(Request $request, $id){
    User::find($id)->update([
        "school_id" => $request->school
    ]);
    return response()->json(["message" => "Berhasil"]);
});

// Route::get("myData", [OptionContoller::class, 'mydata']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
