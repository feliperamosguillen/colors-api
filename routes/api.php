<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\OnlyForAdmins;

Route::group([ 'middleware' => ['api'], 'prefix' => 'users'], static function ($router) {
    Route::post('login', 'Api\UserController@authenticate');
});

Route::post('me', 'Api\UserController@getAuthenticatedUser')->middleware('jwt.verify');

Route::group([ 'middleware' => ['jwt.verify'], 'prefix' => 'colores'], static function ($router) {
    Route::get('', 'Api\ColorsController@index');
    Route::get('/{color}', 'Api\ColorsController@show');
    Route::post('', 'Api\ColorsController@store')->middleware(OnlyForAdmins::class);
    Route::put('/{color}', 'Api\ColorsController@update')->middleware(OnlyForAdmins::class);
    Route::delete('/{color}', 'Api\ColorsController@destroy')->middleware(OnlyForAdmins::class);
});

