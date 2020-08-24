<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware('auth:api')->namespace('v1')->prefix('v1')->group(function () {

    Route::prefix('user')->group(function() {
        Route::get('/all', 'UserController@index')->name('user.all');
        Route::get('/show/{uuid}', 'UserController@show')->name('user.byId');
        Route::post('/add', 'UserController@store')->name('user.add');
        Route::put('/update/{uuid}', 'UserController@update')->name('user.edit');
        Route::delete('/delete/{uuid}', 'UserController@destroy')->name('user.delete');
    });

    Route::prefix('shopkeeper')->group(function() {
        Route::get('/all', 'ShopkeeperController@index')->name('shopkeeper.all');
        Route::get('/list', 'ShopkeeperController@list')->name('shopkeeper.list');
        Route::get('/show/{uuid}', 'ShopkeeperController@show')->name('shopkeeper.byId');
        Route::put('/update/{uuid}', 'ShopkeeperController@update')->name('shopkeeper.edit');
        Route::delete('/delete/{uuid}', 'ShopkeeperController@destroy')->name('shopkeeper.delete');
    });

    Route::prefix('common')->group(function() {
        Route::get('/all', 'CommonController@index')->name('common.all');
        Route::get('/show/{uuid}', 'CommonController@show')->name('common.byId');
        Route::put('/update/{uuid}', 'CommonController@update')->name('common.edit');
        Route::delete('/delete/{uuid}', 'CommonController@destroy')->name('common.delete');
    });

    Route::prefix('wallet-transaction')->group(function() {
        Route::get('/all', 'WalletTransactionController@index')->name('wallet-transaction.all');
        Route::post('/add', 'WalletTransactionController@store')->name('wallet-transaction.add');
        Route::get('/show/{uuid}', 'WalletTransactionController@show')->name('wallet-transaction.byId');
        Route::put('/update/{uuid}', 'WalletTransactionController@update')->name('wallet-transaction.edit');
        Route::delete('/delete/{uuid}', 'WalletTransactionController@destroy')->name('wallet-transaction.delete');
    });

});

/**
 * Opened API
 */
Route::namespace('v1')->prefix('v1')->group(function () {
    Route::prefix('opened')->group(function() {
        Route::prefix('shopkeeper')->group(function() {
            Route::post('/add', 'ShopkeeperController@store')->name('opened.shopkeeper.add');
        });

        Route::prefix('common')->group(function() {
            Route::post('/add', 'CommonController@store')->name('opened.common.add');
        });
    });
});






