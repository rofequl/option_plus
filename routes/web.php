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

    Route::post('/subcategory-select','ProductController@SubcategorySelect');


    Route::get('/category','ProductController@category')->name('category');
    Route::get('/view-category','ProductController@ViewCategory');
    Route::post('/add-category','ProductController@AddCategory');
    Route::get('/delete-category','ProductController@DeleteCategory');
    Route::get('/view-edit-category','ProductController@ViewEditCategory');
    Route::post('/update-category','ProductController@UpdateCategory');

    Route::get('/subcategory','ProductController@subcategory')->name('subcategory');
    Route::get('/view-subcategory','ProductController@ViewSubcategory');
    Route::post('/add-subcategory','ProductController@AddSubcategory');
    Route::get('/delete-subcategory','ProductController@DeleteSubcategory');
    Route::get('/view-edit-subcategory','ProductController@ViewEditSubcategory');
    Route::post('/update-subcategory','ProductController@UpdateSubcategory');

    Route::get('/product','ProductController@product')->name('product');

    Route::post('/add-product','ProductController@AddProduct');

    Route::get('/view-product','ProductController@ViewProduct');

    Route::get('/view-single-product','ProductController@ViewSingleProduct');

    Route::get('/delete-item','ProductController@DeleteItem');
});







