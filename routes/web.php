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

Route::prefix('/')->name('auth.')->group(function()
{
    Route::view('/','auth.login')->name('login');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});


#### User Pegawai
Route::middleware('auth','level:3')->group(function () 
{
    Route::prefix('/')->name('pegawai.')->group(function()
    {
        Route::view('/pegawai','pegawai.index')->name('index');
    });
});


#### User Admin and Kadis
Route::middleware('auth','level:1,2')->group(function () 
{
    Route::prefix('/user')->name('user.')->group(function()
    {
        Route::view('/dashboard','user.index')->name('index');
        Route::view('/surat-masuk','user.surat-masuk')->name('surat-masuk');
        Route::view('/upload-surat','user.upload-surat')->name('upload-surat');
    });
    
    ### Only User Admin
    Route::middleware('auth','level:1')->group(function () 
    {     
        Route::prefix('/admin')->name('admin.')->group(function()
        {
            Route::view('/users','user.admin.users')->name('users');
            Route::get('/testing', function () {
                echo "testing";
            });
        });
        
    });
});
