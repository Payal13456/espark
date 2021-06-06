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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@index')->name('product');
Route::get('/sub-category', 'SubCategoryController@index')->name('sub.category');
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/brand', 'BrandController@index')->name('brand');

Route::get('set-category','CategoryController@setCategory');
Route::get('delete-category/{id}','CategoryController@deleteCategory');
Route::get('set-category/{id}','CategoryController@setCategory');
Route::post('add-category','CategoryController@AddCategory');

Route::get('set-subcategory','SubCategoryController@setSubCategory');
Route::get('delete-subcategory/{id}','SubCategoryController@deleteSubCategory');
Route::get('set-subcategory/{id}','SubCategoryController@setSubCategory');
Route::post('add-subcategory','SubCategoryController@AddSubCategory');

Route::get('set-brand','BrandController@setBrand');
Route::get('delete-brand/{id}','BrandController@deleteBrand');
Route::get('set-brand/{id}','BrandController@setBrand');
Route::post('add-brand','BrandController@AddBrand');

Route::get('set-product','ProductController@setProduct');
Route::get('delete-product/{id}','ProductController@deleteProduct');
Route::get('set-product/{id}','ProductController@setProduct');
Route::post('add-product','ProductController@AddProduct');

Route::get('get-subcategory/{id}','ProductController@getSubcategory');