<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //渲染订单列表模板
    public function order_list()
    {
        return view('home/order/order_list');
    }

    //渲染订单添加模板
    public function order_add()
    {
        return view('home/order/order_add');
    }

}