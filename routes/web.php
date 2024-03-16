<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


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



Route::get('/',[HomeController::class,'home']);
Route::get('login',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'auth_login']);
Route::get('verify/{token}',[AuthController::class,'verify']);
Route::get('register',[AuthController::class,'register']);
Route::post('register',[AuthController::class,'create_user']);
Route::get('forgot_pass',[AuthController::class,'forgot_pass']);
Route::post('forgot_pass',[AuthController::class,'forgot_password']);
Route::get('reset/{token}',[AuthController::class,'reset']);
Route::post('reset/{token}',[AuthController::class,'reset_pass']);



Route::group(['middleware'=>'adminuser'],function(){
    Route::get('panel/dashboard',[DashboardController::class,'dashboard']);
    Route::get('panel/user/list',[UserController::class,'user']);

});
Route::get('logout',[AuthController::class,'logout']);
