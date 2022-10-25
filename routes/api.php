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

Route::get('/product', [\App\Http\Controllers\api\product\indexController::class, 'index']);
Route::get('/product/{productId}', [\App\Http\Controllers\api\product\indexController::class, 'show']);
//Route::post('/login',[\App\Http\Controllers\AuthController::class, 'login']);
//Route::post('/register',[\App\Http\Controllers\AuthController::class, 'register']);

/*Route::group([
    'prefix' => 'auth'
],function(){
    Route::post('/login',[\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register',[\App\Http\Controllers\AuthController::class, 'register']);
});
*/
//Route::post('/admin.login',[\App\Http\Controllers\admin\AuthController::class, 'admin.login']);
//Route::post('/admin.register',[\App\Http\Controllers\admin\AuthController::class, 'admin.register']);

//Route::post('auth/login',[\App\Http\Controllers\AuthController::class, 'login']);
//Route::post('auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']); 

Route::group([
    'middleware'=>['auth:api']
],function(){
    Route::post('/', [\App\Http\Controllers\api\home\indexController::class, 'index']);
    Route::post('/login',[\App\Http\Controllers\AuthController::class, 'login']);
    //Route::post('/register',[\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/authenticate', [\App\Http\Controllers\AuthController::class, 'authenticate']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']); 
    
   // Route::get('/product', [\App\Http\Controllers\api\product\indexController::class, 'index']);
    
    Route::resource('/demand', \App\Http\Controllers\api\demand\indexController::class);
    Route::post('/create-demand', [\App\Http\Controllers\api\demand\indexController::class, 'create']);  
    Route::post('/demand/message', [\App\Http\Controllers\api\demand\indexController::class, 'message']);  
});