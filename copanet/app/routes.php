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

/** 404 Page */
App::missing(function($exception)
{
    if(!Auth::user()) {
        return Response::view('errors.404', array(), 404);
    }
});

/** Home */
Route::get('/', array('as' => 'home', function() {
    return View::make('frontend.home')->with('departamentos', Departamento::all());
}));

/** Login */
Route::group(array('before' => 'logged'), function () {
    /** Admin base */
    Route::get('admin', function () {
        return Redirect::route('login');
    });

    Route::get('login', array('as' => 'login', function()
    {
        return View::make('admin.login');
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

/** Admin safe group */
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function () {

    /** Logout */
    Route::get('logout', array('as' => 'logout', function ()
    {
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect::to('login');
    }));

    /** Posts Resource */
    Route::resource('posts', 'PostsController');
    /** Departamento Resource */
    Route::resource('departamento', 'DepartamentosController', array('except' => array('show')));
    Route::get('departamento/{departamento}/gols', array('as' => 'admin.departamento.gols', 'uses' => 'DepartamentosController@gols'));
    Route::post('departamento/{departamento}/gols', array('as' => 'admin.departamento.gols.save', 'uses' => 'DepartamentosController@golsSave'));
    /** Times Resource */
    Route::resource('time', 'TimesController', array('except' => array('show')));
    Route::get('time/departamento/{departamento}', array('as' => 'admin.time.departamento', 'uses' => 'TimesController@departamento'));
    Route::get('time/{time}/gols', array('as' => 'admin.time.gols', 'uses' => 'TimesController@gols'));
    Route::post('time/{time}/gols', array('as' => 'admin.time.gols.save', 'uses' => 'TimesController@golsSave'));
    /** Artilheiro Resource */
    Route::resource('artilheiro', 'ArtilheirosController', array('except' => array('show')));
    Route::get('artilheiro/time/{time}', array('as' => 'admin.artilheiro.time', 'uses' => 'ArtilheirosController@time'));
    Route::post('artilheiro/foto', array('as' => 'admin.artilheiro.foto', 'uses' => 'ArtilheirosController@foto'));
    Route::get('artilheiro/{artilheiro}/gols', array('as' => 'admin.artilheiro.gols', 'uses' => 'ArtilheirosController@gols'));
    Route::post('artilheiro/{artilheiro}/gols', array('as' => 'admin.artilheiro.gols.save', 'uses' => 'ArtilheirosController@golsSave'));

    /** Admin Dashboard */
    Route::get('dashboard', array('as' => 'dashboard', function ()
    {
        return View::make('admin.dashboard');
    }));
});

