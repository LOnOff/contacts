<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'web'], function ($r) {

    //Home redirect
    $r::get('/', function () {
        return redirect()->route('home');
    });

    $r::get('/home', function () {
        return redirect()->route('home');
    });

    //Auth
    $r::get('login',                    'Auth\LoginController@showLoginForm')->name('login');
    $r::post('login',                   'Auth\LoginController@login');
    $r::post('logout',                  'Auth\LoginController@logout')->name('logout');

    $r::get('password/reset',           'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $r::post('password/email',          'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $r::get('password/reset/{token}',   'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $r::post('password/reset',          'Auth\ResetPasswordController@reset');


    $r::group(['middleware' => 'auth'], function ($r) {
        //Contacts
        $r::get('contacts',         'ContactController@index')->name('home');
        $r::get('get-contacts',     'ContactController@getcontacts')->name('resource.get.contacts');
        $r::post('edit-contact',    'ContactController@editcontact')->name('ajax.edit.contact');
        $r::post('add-contact',     'ContactController@addcontact')->name('ajax.add.contact');
        $r::post('delete-contact',  'ContactController@deletecontact')->name('ajax.delete.contact');
    });

});
