<?php

namespace App\Http\Controllers\Home;

use App\CustomerModel;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    //渲染售后列表
    public function customer_list()
    {
        $table = CustomerModel::all();
        return view('home/customer/customer_list', ['title' => '售后列表', 'table' => $table, 'count' => $table->count()]);
    }
}