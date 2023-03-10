<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;

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

Route::post('/sign-up',[AuthController::class,'store']);

Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']],function(){
   
   Route::post('/logout',[AuthController::class,'logout']);
   
   Route::post('/can',function () {
      return 'dffdafa';
   });
});


Route::get('/get',[AuthController::class,'get']);
