<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    //渲染售后列表
    public function customer_list()
    {
        return view('home/customer/customer_list', ['title' => '售后列表']);
    }
}