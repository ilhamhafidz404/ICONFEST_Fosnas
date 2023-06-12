<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('app');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view("/confirm-logout", 'confirmLogout');
    // Route::view('/{any}', 'app')->where('any', '.*');
    Route::get('/{any}', function () {
        $me = User::with(['roles', 'school'])->whereId(Auth::user()->id)->first();
        return view('app', ["data" => $me]);
    })->where('any', '.*');
});
