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


Route::get('/out', 'MainController@out')->name('out');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'/','middleware'=>['web','auth']],function (){
    Route::post('/save',['uses'=>'MainController@save']);
    Route::post('/roz_all',['uses'=>'MainController@roz_all']);
    Route::post('/get_student',['uses'=>'MainController@get_student']);
     Route::get('/edit_my_magazine',['uses'=>'MainController@index_edit_my_magazine']);
    Route::get('/',['uses'=>'MainController@index','as'=>'index']);

    Route::post('/search',['uses'=>'MainController@search','as'=>'search']);

    Route::post('/',['uses'=>'MainController@visiting_subject','as'=>'user_cabinet']);

    Route::post('/result',['uses'=>'MainController@result','as'=>'result']);

});