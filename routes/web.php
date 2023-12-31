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
        Route::view('/change-password','pegawai.change-password')->name('change-password');
        Route::post('/change-password/store',[AuthController::class,'change_password_store'])->name('change-password.store');

    });
});


#### User Admin and Kadis
Route::middleware('auth','level:1,2')->group(function () 
{
    Route::prefix('/user')->name('user.')->group(function()
    {
        Route::view('/change-password','auth.change-password')->name('change-password');
        Route::post('/change-password',[AuthController::class,'change_password_store'])->name('change-password.store');
        Route::get('/dashboard',[UserController::class,('index')])->name('index');

        #### SURAT MASUK
        Route::get('/surat-masuk',[UserController::class,('kadis_surat_masuk')])->name('surat-masuk');
        Route::get('/surat-masuk/{detail}',[UserController::class,('kadis_surat_masuk_detail')])->name('surat-masuk.detail');
        Route::post('/surat-masuk/{detail}/store',[UserController::class,('kadis_surat_masuk_store')])->name('surat-masuk.store');
        Route::delete('/surat-masuk/{detail}/delete',[UserController::class,('kadis_surat_masuk_delete')])->name('surat-masuk.delete');


        #### UPLOAD SURAT
        Route::view('/upload-surat','user.upload-surat')->name('upload-surat');
        Route::get('/upload-surat/{id}',[UserController::class,('kadis_upload_surat_detail')])->name('upload-surat-detail');
        Route::post('/upload-surat/{detail}/store',[UserController::class,('kadis_upload_surat_store')])->name('upload-surat-store');
        Route::delete('/upload-surat/{id}/delete',[UserController::class,('kadis_upload_surat_delete')])->name('upload-surat-delete');
    });
    
    ### Only User Admin
    Route::middleware('auth','level:1')->group(function () 
    {     
        Route::prefix('/admin')->name('admin.')->group(function()
        {
            ## DETAIL
            Route::get('/surat/detail/{id}',[AdminController::class,'surat_detail'])->name('surat.detail');


            ## LENGKAPI SURAT
            Route::view('/check-surat','user.admin.check-surat')->name('check-surat');
            Route::get('/check-surat/edit/{id}',[AdminController::class,'check_surat_edit'])->name('check-surat-edit');


            ## SURAT MASUK
            Route::view('/surat-masuk','user.admin.surat-masuk')->name('surat-masuk');
            Route::get('/surat-masuk/edit/{id}',[AdminController::class,'surat_masuk_edit'])->name('surat-masuk-edit');
            Route::delete('/surat-masuk/{id}/delete',[AdminController::class,('delete_surat')])->name('surat-masuk-delete');

            
            ## SURAT KELUAR
            Route::view('/surat-keluar','user.admin.surat-keluar')->name('surat-keluar');
            Route::get('/surat-keluar/edit/{id}',[AdminController::class,'surat_keluar_edit'])->name('surat-keluar-edit');
            Route::delete('/surat-keluar/{id}/delete',[AdminController::class,('delete_surat')])->name('surat-keluar-delete');

            
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
