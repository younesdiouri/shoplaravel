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

//Route::get('/', function () {
  //  return view('welcome');
//});


/*
 * Default routes
 */
Route::get('/', 'MainController@index');
Route::get('/home', 'HomeController@index');
Auth::routes();

/*
 * Admin routes
 */
Route::get('/admin/product/new', 'ProductController@newProduct');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/product/destroy/{id}', 'ProductController@destroy');
Route::post('/admin/product/save', 'ProductController@add');



/*
 * Cart routes
 */
Route::post('/store', 'MainController@store');
Route::post('/delete', 'MainController@delete');
Route::get('/cart', 'MainController@cart');
Route::get('logout', 'MainController@doLogout');
Route::get('/pay', 'MainController@payment');

/*
 * Payment routes
 */
Route::post('/checkout', 'OrderController@checkout');
Route::get('order/{orderId}', 'OrderController@viewOrder');
Route::get('order', 'OrderController@index');



