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
//Frontend Controllers................../

Route::get('/','HomeController@index');






//Backend Controllers.................../

Route::get('/login','AdminController@index');

Route::get('/dashboard','SuperAdminController@index');

Route::post('loginvari','AdminController@dashboardlog');

Route::get('logout','SuperAdminController@logout');

// Category Related Routs

Route::get('addCategory','CategoryController@index');
Route::get('allCategory','CategoryController@allCategories');
Route::post('storeCategory','CategoryController@storeCategories');
Route::get('inactiveCategory/{id}','CategoryController@inactiveCategory');
Route::get('activeCategory/{id}','CategoryController@activeCategory');
Route::get('editCategory/{id}','CategoryController@editCategory');
Route::post('updateCategory/{id}','CategoryController@updateCategory');
Route::post('deleteCategory/{id}','CategoryController@deleteCategory');

// Sub Category Related Routes

Route::get('/viewCategory','subCategoryController@index');
Route::get('addSubCategory','subCategoryController@addSubCategory');
Route::post('storeSubCategory','subCategoryController@storeSubCategories');
Route::get('inactiveSubCategory/{id}','subCategoryController@inactiveSubCategory');
Route::get('activeSubCategory/{id}','subCategoryController@activeSubCategory');
Route::get('editSubCategory/{id}','subCategoryController@editSubCategory');
Route::post('updateSubCategory/{id}','subCategoryController@updateSubCategory');
Route::post('deleteSubCategory/{id}','subCategoryController@deleteSubCategory');

//Brand related Routes

Route::get('/viewBrand','BrandController@index');
Route::get('addBrand','BrandController@addBrand');
Route::post('storeBrand','BrandController@storeBrand');
Route::get('inactiveBrand/{id}','BrandController@inactiveBrand');
Route::get('activeBrand/{id}','BrandController@activeBrand');
Route::get('editBrand/{id}','BrandController@editBrand');
Route::post('updateBrand/{id}','BrandController@updateBrand');
Route::post('deleteBrand/{id}','BrandController@deleteBrand');

/*Product Related Routes*/

Route::get('/viewProduct','ProductController@index');
Route::get('addProduct','ProductController@addProduct');
Route::post('storeProduct','ProductController@storeProduct');
Route::get('inactiveProduct/{id}','ProductController@inactiveProduct');
Route::get('activeProduct/{id}','ProductController@activeProduct');
Route::get('editProduct/{id}','ProductController@editProduct');
Route::post('deleteProduct/{id}','ProductController@deleteProduct');
Route::post('updateProduct/{id}','ProductController@updateProduct');





