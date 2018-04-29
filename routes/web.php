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

// Authentication Routes...
//$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//$this->post('login', 'Auth\LoginController@login');
//$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', function () {
    $records = \App\Record::whereHas('fields', function($query) {
        $query->where('name', 'With Me');
    })->get();

    $count = $records->count();

    $records = $records->sortBy(function($item){
        if (strpos($item->artist->name, "The ") === 0) {
            return substr($item->artist->name, 4);
        }
        return $item->artist->name;
    })
    ->groupBy(function($item) {
        return $item->artist->name;
    });
    //dd($records);
    return view('home', ['records' => $records, 'count' => $count]);
});

Route::get('record/{record}', function ($record) {
    return view('record', ['record' => $record]);
})->name('record');
