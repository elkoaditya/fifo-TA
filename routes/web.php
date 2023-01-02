<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
 * Created by : Elko Aditya
 */

Route::get('/test', function () {
    echo "ini Test";

    event(new \App\Events\MyEvent('Hello World'));

});

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::user()){
        if (\Illuminate\Support\Facades\Auth::user()->role == 'superadmin'){
            return redirect('/superadmin/barang')->with('notiv', json_encode([
                'status' => 'warning',
                'header' => 'Login with Session',
                'sub' => 'Selamat datang kembali '.Auth::user()->name,
            ]));
        }
    }
    return view('auth.login');
});

Route::get('/admin/register', [\App\Http\Controllers\UserLoginController::class, 'AdminRegister']);

// Route Untuk Login
Route::post('/login', [\App\Http\Controllers\UserLoginController::class, 'Login']);
Route::post('/logout', [\App\Http\Controllers\UserLoginController::class, 'Logout']);

Route::group(['middleware' => ['authrole:superadmin']], function () {
    Route::group(['prefix' => 'superadmin'], function (){
        Route::get('home', [\App\Http\Controllers\SuperadminController::class, 'Home']);

        // Untuk Management Barang
        Route::group(['prefix' => 'barang'], function (){
            Route::get('/', [\App\Http\Controllers\BarangController::class, 'index']);
            Route::post('/create', [\App\Http\Controllers\BarangController::class, 'create']);
            Route::get('/{id}', [\App\Http\Controllers\BarangController::class, 'show']);
            Route::get('/{id}/history', [\App\Http\Controllers\BarangController::class, 'history']);
            Route::post('/addstock', [\App\Http\Controllers\BarangController::class, 'addStock']);
            Route::post('/outstock', [\App\Http\Controllers\BarangController::class, 'stockOut']);
        });

        // Untuk management users
        Route::group(['prefix' => 'management-users'], function (){
            Route::get('/', [\App\Http\Controllers\ManagementUsersController::class, 'index']);
            Route::get('/data', [\App\Http\Controllers\ManagementUsersController::class, 'data']);
            Route::post('/store', [\App\Http\Controllers\ManagementUsersController::class, 'store']);
            Route::post('/update', [\App\Http\Controllers\ManagementUsersController::class, 'update']);
            Route::post('/delete/{id}', [\App\Http\Controllers\ManagementUsersController::class, 'delete']);
        });

        // Untuk Kategori Management
        Route::group(['prefix' => 'kategori'], function (){
            Route::get('/', [\App\Http\Controllers\KategoriController::class, 'index']);
            Route::get('/data', [\App\Http\Controllers\KategoriController::class, 'data']);
            Route::post('/store', [\App\Http\Controllers\KategoriController::class, 'store']);
            Route::post('/update', [\App\Http\Controllers\KategoriController::class, 'update']);
            Route::post('/delete/{id}', [\App\Http\Controllers\KategoriController::class, 'delete']);
        });

        // Untuk route price management
        Route::group(['prefix' => 'price'], function (){
            Route::get('/', [\App\Http\Controllers\PriceController::class, 'index']);
            Route::post('/store', [\App\Http\Controllers\PriceController::class, 'store']);
            Route::post('/delete/{id}', [\App\Http\Controllers\PriceController::class, 'delete']);
        });


        Route::get('users/owner', [\App\Http\Controllers\UserController::class, 'ListOwner']);
        Route::post('users/owner/create', [\App\Http\Controllers\UserController::class, 'CrateOwner']);

        Route::get('users/client', [\App\Http\Controllers\SuperadminController::class, 'Home']);
    });
});




/**
 * Untuk All user Role
 */
Route::group(['middleware' => ['authrole:superadmin']], function () {
    Route::get('/user/setting', [\App\Http\Controllers\UserController::class, 'Setting']);
    Route::get('/user/security', [\App\Http\Controllers\UserController::class, 'SettingPassword']);
    Route::post('/user/setting/save', [\App\Http\Controllers\UserController::class, 'SaveSetting']);
    Route::post('/user/setting/savepassword', [\App\Http\Controllers\UserController::class, 'ChangePass']);
});
Route::get('/redirect/home', function (){
    if (Auth::user()->role == 'superadmin'){
        return redirect('/superadmin/home');
    }
    dd('cek route');
});
