<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginController;
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
#Route::get('/', [TestController::class, 'index']);
#Route::get('/', [LoginController::class, 'show']);
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@authenticate')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Post crud Routes
         */
        Route::get('/posts', 'PostsController@index')->name('posts.index');
        Route::get('/create', 'PostsController@create')->name('posts.create');
        Route::post('/store', 'PostsController@store')->name('posts.store');
        Route::get('/show/{id}', 'PostsController@show')->name('posts.show');
        Route::get('/edit/{id}', 'PostsController@edit')->name('posts.edit');
        Route::put('/update/{id}', 'PostsController@update')->name('posts.update');
        Route::delete('/delete/{id}', 'PostsController@destroy')->name('posts.destroy');
        
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

    
});

