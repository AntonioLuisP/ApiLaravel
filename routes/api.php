<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', 'AuthController@login')->name('login');

Route::post('/auth/logout', 'AuthController@logout')->name('logout');
// Route::post('/auth/refresh', 'AuthController@refresh')->name('refresh');
// Route::post('/auth/me', 'AuthController@me')->name('me');


Route::prefix('denuncias')->group(function () {
    Route::get('', 'DenunciaController@index');
    Route::post('nova', 'DenunciaController@store')->name('denuncias.nova');
    Route::get('exibe/{id}', 'DenunciaController@show');
});
