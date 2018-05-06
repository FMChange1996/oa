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
    //HomeController
    Route::get('home/index','HomeController@index');
    Route::get('home/welcome','HomeController@welcome');
    Route::get('home/logout','HomeController@logout');
    //AdminController
    Route::get('home/admin_list/username={username}', 'AdminController@admin_list');
    Route::get('home/admin_edit/id={id}', 'AdminController@admin_edit');
    Route::get('home/admin_add','AdminController@admin_add');
    Route::post('home/update_user','AdminController@update_user');
    Route::post('home/add_user', 'AdminController@add_user');
    Route::post('home/change_status','AdminController@change_status');
    Route::get('home/users_status', 'AdminController@users_status');
    Route::post('home/change_user','AdminController@change_user');
    Route::post('home/delete_user','AdminController@delete_user');
    Route::post('home/recovery_user','AdminController@recovery_user');
    //MemberController
    Route::get('home/member_list', 'MemberController@member_list');
    Route::get('home/member_add', 'MemberController@member_add');
    Route::get('home/member_del', 'MemberController@member_del');
    Route::post('home/add_member', 'MemberController@add_member');
    Route::get('home/seach_user', 'MemberController@seach_user');
    Route::get('home/member_edit/id={id}', 'MemberController@member_edit');
    Route::post('home/edit_member', 'MemberController@edit_member');
    Route::post('home/del_member','MemberController@del_member');
    Route::get('home/seach_name', 'MemberController@seach_name');
    Route::post('home/recover_all', 'MemberController@recovery_all');
    Route::post('home/delete_member', 'MemberController@deleted_member');
    Route::post('home/recovery_member', 'MemberController@rec_member');
    //OrderController
    Route::get('home/order_list', 'OrderController@order_list');
    Route::get('home/order_add', 'OrderController@order_add');
    Route::get('home/order_edit/id={id}', 'OrderController@order_edit');
    Route::post('home/add_order', 'OrderController@add_order');
    Route::post('home/del_order', 'OrderController@del_order');
    //ExpressController
    Route::get('home/search_num', 'ExpressController@search_num');
    //CustomerContirller
    Route::get('home/customer_list','CustomerController@custmer_list');
});
