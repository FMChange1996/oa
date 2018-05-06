<?php

namespace App\Http\Controllers\Home;

use App\CustomerModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //渲染售后列表
    public function customer_list()
    {
        $table = CustomerModel::all();
        return view('home/customer/customer_list', ['title' => '售后列表', 'table' => $table, 'count' => $table->count()]);
    }

    public function customer_edit($id)
    {

    }

    //渲染添加售后订单模板
    public function customer_add()
    {
        return view('home/customer/customer_add', ['title' => '添加售后']);
    }

    //使用软删除方法删除售后订单
    public function del_customer(Request $request)
    {
        $data = $request->all();
        $find = CustomerModel::find($data['id']);
        $find->delete();
        if ($find->trashed()) {
            return response()->json(['code' => 200, 'message' => '删除成功']);
        } else {
            return response()->json(['code' => 500, 'message' => '删除失败']);
        }

    }

}