<?php


use App\Http\Controllers\APIJenisController;
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

Route::post('/jenis/tambah', [APIJenisController::class,'store']);
Route::get('/jenis', [APIJenisController::class,'index']);
Route::get('/jenis/edit/{id}', [APIJenisController::class,'show']);
Route::post('/jenis/edit/{id}', [APIJenisController::class,'update']);
Route::get('/jenis/delete/{id}', [APIJenisController::class,'destroy']);


