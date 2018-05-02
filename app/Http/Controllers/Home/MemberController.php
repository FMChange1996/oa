<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\MemberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    //渲染客户列表模板
    public function member_list()
    {
        $table = MemberModel::all();
        return view('home/member/member_list', ['title' => '客户列表', 'table' => $table, 'count' => $table->count()]);
    }

    //渲染客户删除模板
    public function member_del()
    {
        return view('home/member/member_del');
    }

    //渲染客户添加模板
    public function member_add()
    {
        return view('home/member/member_add', ['title' => '客户添加']);
    }

    //添加客户到数据库
    public function add_member(Request $request)
    {
        $data = $request->all();
        //错误提示信息
        $message = [
            'username.required' => '客户名字不能为空',
            'sex.required' => '客户性别未选择',
            'mail.email' => '邮箱账号格式不正确',
            'mobile.required' => '手机号不能为空',
            'mobile.min' => '手机号不正确',
            'mobile.max' => '手机号不正确',
            'address.required' => '客户地址不能为空'
        ];
        if ($data['mail'] == null) {
            $validate = Validator::make($data, [
                'username' => 'required',
                'sex' => 'required',
                'mobile' => 'required|min:11|max:12',
                'address' => 'required'
            ], $message);
        } else {
            $validate = Validator::make($data, [
                'username' => 'required',
                'sex' => 'required',
                'mail' => 'email',
                'mobile' => 'required|min:11|max:12',
                'address' => 'required'
            ], $message);
        }

        //对提交内容进行检验
        if ($validate->fails()) {
            return response()->json(['status' => 1, 'message' => $validate->errors()->first()]);
        } else {
            $res = MemberModel::insert([
                'username' => $data['username'],
                'sex' => $data['sex'],
                'mobile' => $data['mobile'],
                'mail' => $data['mail'],
                'address' => $data['address'],
                'create_at' => $data['create_at']
            ]);
            if ($res == true) {
                return response()->json(['status' => 0, 'message' => '增加成功']);
            } else {
                return response()->json(['status' => 1, 'message' => '增加失败']);
            }
        }

    }

    //客户筛选
    public function seach_user(Request $request)
    {
        $data = $request->all();
        $username = $data['seach_user'];
        if ($username == null) {
            $table = MemberModel::all();
            return response()->view('home/member/member_list', ['title' => '客户列表', 'table' => $table, 'count' => $table->count()]);
        } else {
            $table = MemberModel::where('username', $username)->get();
            return response()->view('home/member/member_list', ['title' => '客户列表', 'table' => $table, 'count' => $table->count()]);
        }

    }

    //渲染客户编辑模板
    public function member_edit($id)
    {
        $data = MemberModel::where('id', $id)->first();
        return view('home/member/member_edit', ['title' => '客户编辑', 'table' => $data]);
    }

    //修改客户资料
    public function edit_member(Request $request)
    {
        $data = $request->all();

    }
}