<?php

namespace App\Http\Controllers\Home;

use App\CustomerModel;
use App\Http\Controllers\Controller;
use App\SystemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //渲染售后列表
    public function customer_list()
    {
        $table = CustomerModel::all();
        return view('home/customer/customer_list', ['title' => '售后列表', 'table' => $table, 'count' => $table->count()]);
    }

    //渲染售后订单编辑模板
    public function customer_edit($id)
    {
        $table = CustomerModel::find($id);
        return view('home/customer/customer_edit',['title' => '编辑售后订单' , 'table' => $table]);
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
            SystemModel::insert([
                'username' => session() -> get('username'),
                'context' => '删除售后订单，订单号：'.$find -> customer_id,
                'time' => time()
            ]);
            return response()->json(['code' => 200, 'message' => '删除成功']);
        } else {
            return response()->json(['code' => 500, 'message' => '删除失败']);
        }

    }

    //添加售后订单
    public function add_customer(Request $request)
    {
        $data = $request -> all();
        $message = [
            'name.required' => '客户名字不能为空',
            'mobile.required' => '手机号不能为空',
            'mobile.min' => '手机号格式不正确',
            'mobile.max' => '手机号格式不正确',
            'address.required' => '地址不能为空',
            'context.required' => '售后内容不能为空'
        ];
        $validate = Validator::make($data,[
            'name' => 'required',
            'mobile' => 'required|min:11|max:12',
            'address' => 'required',
            'context' => 'required'
        ],$message);

        if ($validate -> fails()){
            return response() -> json(['code' => 500 , 'message' => $validate -> errors() -> first()]);
        }else{
            $datas = [
                'customer_id' => 'SH'.date('YmdHis') . rand(10000, 99999),
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'address' => $data['address'],
                'context' => $data['context'],
                'status' => 0,
                'create_at' => time()
            ];
            $insert = CustomerModel::insert($datas);
            if ($insert == true){
                SystemModel::insert([
                    'username' => session() -> get('username'),
                    'context' => '添加售后订单，订单号：'.$datas['customer_id'],
                    'time' => time()
                ]);
                return response() -> json(['code' => 200 , 'message' => '添加成功']);
            }else{
                return response() -> json(['code' => 500 , 'message' => '添加失败']);
            }
        }
    }

    //更新售后订单信息
    public function update_customer(Request $request)
    {
        $data = $request -> all();
        $message = [
            'context.required' => '售后内容不能为空',
            'status.required' => '售后状态不能为空'
        ];

        $validate = Validator::make($data,[
            'context' => 'required',
            'status' => 'required'
        ],$message);

        if ($validate -> fails()){
            return response() -> json(['code' => 500 ,'message' => $validate -> errors() -> first()]);
        }else{
            $find = CustomerModel::find($data['id']);
            $find -> context = $data['context'];
            $find -> status = $data['status'];
            if ($find ->save()){
                return response() -> json(['code' => 200 , 'message' => '更新成功']);
            }else{
                return response() -> json(['code' => 500 , 'message' => '更新失败']);
            }
        }
    }
}