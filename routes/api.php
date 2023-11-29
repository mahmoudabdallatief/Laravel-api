<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' =>['api','checkPassword','changeLanguage'] ], function ()  {
    
    Route::post('get-main-categories',[CatController::class, 'index']);
    Route::post('get-category-byId', [CatController::class,'getCategoryById']);
    Route::post('change-category-status', [CatController::class,'changeStatus']);


    
        Route::post('login',[AuthController::class,'login']);

        Route::post('logout',[AuthController::class,'logout'])->middleware(['auth.guard:admin-api']);
          //invalidate token security side
          Route::post('user/login',[UserController::class,'login']) ;
         Route::post('user/logout',[UserController::class,'logout'])->middleware(['auth.guard:user-api']);
         //broken access controller user enumeration
         Route::group([ 'middleware' => 'auth.guard:user-api'],function (){
            Route::post('profile',function(){
                return  Auth::user(); // return authenticated user data
            }) ;
        });
     
  
});
Route::group(['middleware' => ['api','checkPassword','changeLanguage','auth.guard:admin-api']], function () {
    Route::get('offers',[CatController::class, 'index']);
});
 