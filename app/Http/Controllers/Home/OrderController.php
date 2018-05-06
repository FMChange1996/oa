<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //渲染订单列表模板
    public function order_list()
    {
        $table = OrderModel::all();
        return view('home/order/order_list', ['title' => '订单列表', 'table' => $table, 'count' => $table->count()]);
    }

    //渲染订单添加模板
    public function order_add()
    {
        return view('home/order/order_add', ['title' => '添加订单']);
    }

    //添加订单到数据库
    public function add_order(Request $request)
    {
        $data = $request->all();
        $message = [
            'name.required' => '收件人名字必须填写',
            'mobile.required' => '收件人电话必须填写',
            'mobile.min' => '手机号格式不正确',
            'mobile.max' => '手机号格式不正确',
            'address.required' => '收件人地址必须填写',
            'order_pay.required' => '支付方式必须选择',
            'goods.required' => '购买物品必须填写',
            'order_money.required' => '订单金额必须填写'
        ];
        $validate = Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required|min:11|max:12',
            'address' => 'required',
            'order_pay' => 'required',
            'goods' => 'required',
            'order_money' => 'required'
        ], $message);
        if ($validate->fails()) {
            return response()->json(['code' => 500, 'message' => $validate->errors()->first()]);
        } else {
            $datas = [
                'order_id' => date('YmdHis') . rand(10000, 99999),
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'address' => $data['address'],
                'order_status' => 0,
                'goods' => $data['goods'],
                'order_pay' => $data['order_pay'],
                'order_money' => $data['order_money'],
                'create_at' => time()
            ];
            $response = OrderModel::insert($datas);
            if ($response == true) {
                return response()->json(['code' => 200, 'message' => '添加成功']);
            } else {
                return response()->json(['code' => 500, 'message' => '添加失败']);
            }
        }
    }

    //使用软删除方式删除订单
    public function del_order(Request $request)
    {
        $data = $request->all();
        $find = OrderModel::find($data['id']);
        $find->delete();
        if ($find->trashed()) {
            return response()->json(['code' => 200, 'message' => '删除成功']);
        } else {
            return response()->json(['code' => 500, 'message' => '删除失败']);
        }
    }

    //渲染订单编辑模板
    public function order_edit($id)
    {
        $table = OrderModel::find($id);
        return view('home/order/order_edit', ['title' => '编辑订单', 'table' => $table]);
    }

    //发货操作
    public function send_goods(Request $request)
    {
        $data = $request->all();
        $message = [
            'id.required' => '订单号不能为空',
            'shipping_num.required' => '快递单号不能为空'
        ];
        $validate = Validator::make($data, [
            'id' => 'required',
            'shipping_num' => 'required'
        ], $message);
        if ($validate->fails()) {
            return response()->json(['code' => 500, 'message' => $validate->errors()->first()]);
        } else {
            $find = OrderModel::find($data['id']);
            $find->shipping_num = $data['shipping_num'];
            $find->order_status = 1;
            if ($find->save()) {
                return response()->json(['code' => 200, 'message' => '发货成功']);
            } else {
                return response()->json(['code' => 500, 'message' => '发货失败']);
            }
        }

    }

    //更改订单信息到数据库
    public function update_order(Request $request)
    {
        $data = $request->all();
        $message = [
            'name.required' => '收件人不能为空',
            'mobile.required' => '手机号不能为空',
            'mobile.min' => '手机号格式不正确',
            'mobile.max' => '手机号格式不正确',
            'address.required' => '地址不能为空',
            'goods.required' => '购买清单不能为空',
        ];
        $validate = Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required|min:11|max:12',
            'address' => 'required',
            'goods' => 'required'
        ], $message);


        if ($validate->fails()) {
            return response()->json(['code' => 500, 'message' => $validate->errors()->first()]);
        } else {
            $find = OrderModel::find($data['id']);
            $find->name = $data['name'];
            $find->mobile = $data['mobile'];
            $find->address = $data['address'];
            $find->goods = $data['goods'];
            if ($find->save()) {
                return response()->json(['code' => 200, 'message' => '更新成功']);
            } else {
                return response()->json(['code' => 500, 'message' => '更新失败']);
            }
        }
    }
}