<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/news', function () {
   return view('front.news');
});

Route::get('changeLang', 'ChangeLanguageController@change')->name('changeLang');

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'verified']
    ],

    function () {
        Route::get('/', 'AdminController@index')->name('admin');

        Route::resource('users', 'UsersController', ['as' => 'admin']);

        Route::resource('skills', 'SkillsController', ['as' => 'admin']);

        Route::resource('professions', 'ProfessionsController', ['as' => 'admin']);

        Route::resource('teams', 'TeamsController', ['as' => 'admin']);

        Route::resource('posts', 'PostsController', ['as' => 'admin']);

        Route::post('posts/{post}/photos', 'PhotoController@store')->name('admin.photos.store');
        Route::PUT('photos/{photo}/update', 'PhotoController@update')->name('admin.photos.update');
        Route::delete('photos/{photo}', 'PhotoController@destroy')->name('admin.photos.destroy');
    }
);
