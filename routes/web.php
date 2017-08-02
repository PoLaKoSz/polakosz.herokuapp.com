<?php

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    if ( !isset($this->groupStack[1]['prefix']) ) {
        // TODO: Redirect request to the localized URL: polakosz.dev/ -> polakosz.dev/hu
    }

    Route::get('/', 'PagesController@index');

    Route::get('/home', 'HomeController@index');
    
    Route::get ('/movies/new', 'MoviesController@create');
    Route::post('/movies',     'MoviesController@store');

    Route::get('/about-me', 'AboutMeController@index');

    Route::get('/projects', 'ProjectsController@index');

    Route::post('/contact', 'ContactController@store');

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    
    if (env('APP_REG_ENABLED'))
        Route::post('register', 'Auth\RegisterController@register');
    else
        Route::any('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});
