<?php

use App\Http\Controllers\AdminController;
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
        Route::delete('/surat-masuk/{detail}/delete',[UserController::class,('kadis_surat_masuk_delete')])->name('surat-masuk.delete');


        #### UPLOAD SURAT
        Route::view('/upload-surat','user.upload-surat')->name('upload-surat');
        Route::get('/upload-surat/{surat:id}',[UserController::class,('kadis_upload_surat_detail')])->name('upload-surat-detail');
        Route::post('/upload-surat/{detail}/store',[UserController::class,('kadis_upload_surat_store')])->name('upload-surat-store');
        Route::delete('/upload-surat/{id}/store',[UserController::class,('kadis_upload_surat_delete')])->name('upload-surat-delete');
    });
    
    ### Only User Admin
    Route::middleware('auth','level:1')->group(function () 
    {     
        Route::prefix('/admin')->name('admin.')->group(function()
        {

            ## SURAT MASUK
            Route::view('/surat-masuk','user.admin.surat-masuk')->name('surat-masuk');
            
            ## SURAT KELUAR
            Route::view('/surat-keluar','user.admin.surat-keluar')->name('surat-keluar');
            
            ## UPLOAD SURAT
            Route::view('/riwayat-upload-surat','user.admin.riwayat-upload-surat')->name('riwayat-upload-surat');
            Route::view('/upload-surat', 'user.admin.upload-surat')->name('upload-surat');
            Route::post('/upload-surat/store',[AdminController::class,'upload_surat_store'])->name('upload-surat-store');
            Route::get('/upload-surat/edit/{id}',[AdminController::class,'upload_surat_edit'])->name('upload-surat-edit');
            Route::post('/upload-surat/edit/{id}/store',[AdminController::class,'edit_surat_store'])->name('upload-surat-edit-store');
            Route::delete('/upload-surat/{id}/delete',[AdminController::class,('delete_surat')])->name('upload-surat-delete');


            Route::view('/users','user.admin.users')->name('users');
            Route::get('/testing', function () {
                echo "testing";
            });
        });
        
    });
});
