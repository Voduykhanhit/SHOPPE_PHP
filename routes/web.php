<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/pagenotfound','PagesController@pagenotfound')->name('notfound');
Route::group(['prefix'=>'home'],function(){
    Route::get('/','PagesController@getHome');
    Route::get('/details/{idProduct}','PagesController@getDetails');
    Route::get('/showcart/{idProduct}','PagesController@getShowCart');
    Route::get('/delcart/{rowId}','PagesController@getDelCart');
    Route::get('/category/{category_id}','PagesController@getCategory');
    Route::get('/viewcart','PagesController@getViewCart');
    Route::get('/updatecart','PagesController@postUpdateCart');
    Route::post('/charge','PagesController@postCharge');
    Route::get('/login','PagesController@getLogin');
    Route::post('/login','PagesController@postLogin');
    Route::get('/register','PagesController@getRegister');
    Route::post('/register','PagesController@postRegister');
    Route::get('/logout','PagesController@getLogOut');
    Route::get('/checkout','PagesController@getCheckOut');
    Route::post('/checkout','PagesController@postCheckOut');
});