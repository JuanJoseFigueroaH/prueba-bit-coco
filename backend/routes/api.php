<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
], function () {
    Route::get('producto/index', 'ProductoController@index');
    Route::post('producto/store', 'ProductoController@store');
    Route::get('lista-producto/index/{user_id}', 'ListaProductoController@index');
    Route::post('lista-producto/store', 'ListaProductoController@store');
    Route::put('lista-producto/update/{id}', 'ListaProductoController@update');
    Route::get('lista-producto/delete/{id}', 'ListaProductoController@destroy');

    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/logout', 'AuthController@logout');
    Route::post('auth/refresh', 'AuthController@refresh');
    Route::post('auth/me', 'AuthController@me');
});
