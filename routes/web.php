<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CandidateController;
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
//route login





Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'process']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

//route barang
Route::resource('/barang', BarangController::class)->middleware('auth');
// Route::resource('/candidate', CandidateController::class)->middleware('auth');

Route::get('/candidate/add_candidate/{id}', [CandidateController::class, 'add_candidate'])->name('candidate.add_candidate')->middleware('auth');
Route::post('/candidate/store_candidate', [CandidateController::class, 'store_candidate'])->middleware('auth');
Route::get('/candidate/show', [CandidateController::class, 'show'])->middleware('auth');
Route::get('/candidate/result', [CandidateController::class, 'result'])->middleware('auth');
Route::get('/candidate/approve/{id}', [CandidateController::class, 'approve'])->middleware('auth');
