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
    return redirect('home');
});

Route::group(['namespace' => 'Home'],function (){
    Route::get('home','HomeController@home');
    Route::post('home/check','HomeController@check');

});

Route::group(['namespace' => 'Home','middleware' => 'home'],function (){
    Route::get('home/index','HomeController@index');
    Route::get('home/welcome','HomeController@welcome');
    Route::get('home/logout','HomeController@logout');
    Route::get('home/member_list','HomeController@member_list');
    Route::get('home/member_del','HomeController@member_del');
    Route::get('home/order_list','HomeController@order_list');
    Route::get('home/admin_list/username={username}','AdminController@admin_list');
    Route::get('home/order_add','HomeController@order_add');
    Route::get('home/admin_role','AdminController@admin_role');
    Route::get('home/admin_cate','AdminController@admin_cate');
    Route::get('home/admin_rule','AdminController@admin_rule');
    Route::get('home/admin_edit/id={id}', 'AdminController@admin_edit');
    Route::get('home/admin_add','AdminController@admin_add');
    Route::post('home/update_user','AdminController@update_user');
    Route::post('home/add_user', 'AdminController@add_user');
    Route::post('home/change_status','AdminController@change_status');
    Route::get('home/users_status', 'AdminController@users_status');
});
