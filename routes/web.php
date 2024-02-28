<?php

use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[UserController::class,'login']);
Route::post('proseslogin',[UserController::class,'proseslogin']);
Route::get('register',[UserController::class,'register']);
Route::post('prosesregister',[UserController::class,'prosesregister']);

Route::middleware(['auth'])->group(function(){
    
    Route::get('timeline',[GaleriController::class,'timeline']);
    Route::post('uploadfoto',[GaleriController::class,'upload']);
    Route::post('editfoto/{id}',[GaleriController::class,'edit']);
    Route::get('hapusfoto/{id}',[GaleriController::class,'destroy']);

    Route::get('logout',[UserController::class,'logout']);

});