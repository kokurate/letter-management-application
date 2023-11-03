<?php

use App\Http\Controllers\AuthController;
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

        #### SURAT MASUK
        Route::get('/surat-masuk',[UserController::class,('kadis_surat_masuk')])->name('surat-masuk');
        Route::get('/surat-masuk/{detail}',[UserController::class,('kadis_surat_masuk_detail')])->name('surat-masuk.detail');
        Route::post('/surat-masuk/{detail}/store',[UserController::class,('kadis_surat_masuk_store')])->name('surat-masuk.store');


        #### UPLOAD SURAT
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
