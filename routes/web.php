<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'verified']
    ],

    function () {
        Route::get('/', 'AdminController@index')->name('admin');

        Route::resource('users', 'UsersController', ['as' => 'admin']);
    }
);
