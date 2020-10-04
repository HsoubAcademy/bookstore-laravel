<?php

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

// Route::middleware('auth:sanctum')->get('/posts', function (Request $request) {
//     return "its ok";
// });

Route::post('create-payment' , 'App\Http\Controllers\PurchaseController@createPayment');
Route::post('execute-payment', 'App\Http\Controllers\PurchaseController@executePayment');

//XnDpATWb7sFhBQKIyuXJ1R826BCGKHFC98G0vEhr