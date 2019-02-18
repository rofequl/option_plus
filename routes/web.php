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

Route::get('/register','homeController@register');

Route::get('/login','homeController@login')->name('login');

Route::post('/login','homeController@UserLogin');

Route::get('/forget-password','homeController@forgetpassword')->name('forget-password');

Route::post('/firstRegister','homeController@firstRegister');

Route::group(['middleware' => 'CheckLogin'], function () {

    Route::get('/','homeController@index')->name('/');

    Route::get('/category','ProductController@category')->name('category');

    Route::get('/view-category','ProductController@ViewCategory');

    Route::post('/add-category','ProductController@AddCategory');
});







