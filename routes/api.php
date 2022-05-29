<?php

use App\Http\Controllers\catholicMass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/reading', [catholicMass::class, 'reading']);
Route::get('/read/{read}', [catholicMass::class, 'read']);
Route::get("/paystack_verify/{ref}",[catholicMass::class, 'paystack_verify']);
Route::post("/paymentdata",[catholicMass::class,'paymentdata']);
Route::post("/insertreading", [catholicMass::class, 'insertreading']);
Route::post("/searchreading", [catholicMass::class, "searchreading"]);
Route::get("/lastrow", [catholicMass::class,"lastrow"]);

Route::middleware('auth:sanctum')->group( function(){
//
});
