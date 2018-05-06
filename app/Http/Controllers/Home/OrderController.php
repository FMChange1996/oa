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
            'goods.required' => '购买物品必须填写'
        ];
        $validate = Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required|min:11|max:12',
            'address' => 'required',
            'order_pay' => 'required',
            'goods' => 'required'
        ], $message);
        if ($validate->fails()) {
            return response()->json(['code' => 500, 'message' => $validate->errors()->first()]);
        } else {
            $datas = [
                'order_id' => date('YmdHis') . rand(10000, 99999),
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'address' => $data['address'],
                'goods' => $data['goods'],
                'order_pay' => $data['order_pay'],
                'shipping' => $data['shipping'],
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
        if ($find->delete()) {

        }
    }

}