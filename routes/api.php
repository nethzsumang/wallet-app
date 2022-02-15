<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(static function () {
    Route::get('/', static function () {
        return response()->json([
            'message' => 'Welcome to the API.',
        ]);
    });
    
    Route::prefix('/users')->group(static function () {
        Route::post('/', 'UserController@registerUser')->middleware('scopes:user:create');
        Route::get('/', 'UserController@getUsers')->middleware('scopes:user:read');
    });

    Route::prefix('/accounts')->group(static function () {
        Route::post('/', 'AccountController@createAccount')->middleware('scopes:account:create');
        Route::get('/', 'AccountController@getAccounts')->middleware('scopes:account:read');
    });
});
