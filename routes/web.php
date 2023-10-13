<?php

use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LoginController;
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

Route::get('/',[CalculatorController::class, 'index']);
Route::post('hasil',[CalculatorController::class, 'hasil']);


Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'cekLogin']);



Route::get('logout',[LoginController::class, 'logout']);





Route::get('admin/jenis',[JenisController::class, 'index'])->middleware('auth');

