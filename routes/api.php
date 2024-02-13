<?php

use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\KinerjaPredikatController;
use App\Http\Controllers\ProvinsiController;
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

Route::get('helloworld/greets',[HelloWorldController::class,'greets']);
Route::post('helloworld/',[HelloWorldController::class,'helloworld']);

Route::post('kinerja/predikat',[KinerjaPredikatController::class,'predikat']);


Route::get('provinsi/list',[ProvinsiController::class,'list']);
Route::post('provinsi/create',[ProvinsiController::class,'create']);
Route::get('provinsi/read/{id}',[ProvinsiController::class,'read']);
Route::put('provinsi/update/{id}',[ProvinsiController::class,'update']);
Route::delete('provinsi/delete/{id}',[ProvinsiController::class,'delete']);