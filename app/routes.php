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

// Rutas públicas
Route::get('/', 'HomeController@showLanding');
Route::get('sign-up', 'HomeController@showSignUp');
Route::post('sign-up', array('before' => 'csrf',
            'uses' => 'HomeController@signUp'));
Route::post('login', array('before' => 'csrf',
            'uses' => 'HomeController@login'));
Route::get('logout', 'HomeController@logout');

// Rutas para registrados
Route::group(array('before' => 'auth'), function()
{
    Route::get('index', 'HomeController@showIndex');
});

// Páginas de artistas o grupos con subdominio.
// Route::group(array('domain' => '{account}.myapp.com'), function()
// {

//     Route::get('page/{id}', function($account, $id)
//     {
//         //
//     });

// });
