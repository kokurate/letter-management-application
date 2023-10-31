<?php

use App\Http\Controllers\AuthController;
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

Route::prefix('/')->name('auth.')->group(function(){
    Route::view('/','auth.login')->name('login');
    // Route::post('/login/attempt', AuthController::class,'')
});

#### User Pegawai
Route::view('/pegawai','pegawai.index')->name('pegawai');


#### User Admin and Kadis
Route::prefix('/user')->name('user.')->group(function(){
    Route::view('/dashboard','user.index')->name('index');
});