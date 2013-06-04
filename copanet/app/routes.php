<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** HOME */
Route::get('/', function() {
    return View::make('hello');
});
/** LOGIN */
Route::group(array('before' => 'logged'), function () {
    /** ADMIN-BASE */
    Route::get('admin', function () {
        return Redirect::route('login');
    });

    Route::get('login', array('as' => 'login', function()
    {
        return View::make('login');
    }));

    Route::post('login', array('before' => 'csrf', function ()
    {
        $credentials = array(
            'username' => Input::get('username'),
            'password' =>Input::get('password'),
        );
        if(Auth::attempt($credentials)){
            return Redirect::intended('admin/dashboard');
        }

        return Redirect::to('login')->withErrors(array('login' => 'Usuário ou Senha inválidos'));
    }));
});

/** ADMIN SAFE GROUP */
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function () {

    /** LOGOUT */
    Route::get('logout', function ()
    {
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect::to('login');
    });

    /** POSTS RESOURCE */
    Route::resource('posts', 'PostsController');

    /** ADMIN DASHBOARD */
    Route::get('dashboard', array('as' => 'dashboard', 'before' => 'auth', function ()
    {
        return View::make('admin.dashboard');
    }));
});
