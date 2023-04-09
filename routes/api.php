<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\resepcontroller;
use App\Http\Controllers\ratingcontroller;
use App\Http\Controllers\komentarcontroller;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/resep', [resepcontroller::class, 'tambah']);
// Route::post('/resep/{id}/ratings', [ratingcontroller::class, 'addrating'])->name('resep.addrating')->middleware('auth');
// Route::post('/rating', [ratingcontroller::class, 'rate']);
// Route::post('/resep/{id}/rate', [ratingcontroller::class, 'rate']);
Route::post('/resep/{id}/rating', [ratingcontroller::class, 'store']);
Route::post('/resep/{id}/komentar', [komentarcontroller::class, 'store']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

