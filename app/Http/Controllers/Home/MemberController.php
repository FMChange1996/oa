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

    //渲染已删除客户列表
    public function member_del()
    {
        $table = MemberModel::onlyTrashed() -> get();
        return view('home/member/member_del', ['title' => '客户删除列表', 'table' => $table, 'count' => $table->count()]);
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
        $message = [
            'mail.email' => '邮箱格式不正确',
            'mobile.required' => '手机号不能为空',
            'mobile.min' => '手机号格式不正确',
            'mobile.max' => '手机号格式不正确',
            'address.required' => '地址不能为空'
        ];
        if ($data['mail'] == null){
            $validate = Validator::make($data,[
                'mobile' => 'required|min:11|max:12',
                'address' => 'required'
            ],$message);
        }else{
            $validate = Validator::make($data,[
                'mail' => 'email',
                'mobile' => 'required|min:11|max:12',
                'address' => 'required'
            ],$message);
        }

        if ($validate -> fails()){
            return response() -> json(['status' => 1 , 'message' => $validate -> errors() -> first()]);
        }else{
            $find = MemberModel::find($data['id']);
            $find -> mobile = $data['mobile'];
            $find -> mail = $data['mail'];
            $find -> address = $data['address'];
            if ($find -> save()){
                return response() -> json(['status' => 0 , 'message' => '保存成功']);
            }else{
                return response() -> json(['status' => 1 , 'message' => '保存失败']);
            }

        }





    }

    //使用软删除方法删除客户
    public function del_member(Request $request)
    {
        $data = $request -> all();
        $find = MemberModel::find($data['id']);
        $find -> delete();
        if ($find -> trashed()){
            return response() -> json(['code' => 200]);
        }else{
            return response() -> json(['code' => 500]);
        }
    }

    //强制删除
    public function deleted_member(Request $request)
    {
        $data = $request->all();
        $find = MemberModel::withTrashed()->where('id', $data['id']);
        if ($find->forceDelete()) {
            return response()->json(['code' => 200, 'message' => '删除成功']);
        } else {
            return response()->json(['code' => 500, 'message' => '删除失败']);
        }

    }

    //恢复已删除的客户
    public function rec_member(Request $request)
    {
        $data = $request->all();
        $find = MemberModel::withTrashed()->where('id', $data['id']);
        if ($find->restore()) {
            return response()->json(['code' => 200, 'message' => '恢复成功']);
        } else {
            return response()->json(['code' => 500, 'message' => '恢复失败']);
        }

    }

    //恢复所有被删除的客户
    public function recovery_all(Request $request)
    {
        $data = $request->all();
        if ($data['code'] == 200) {
            $recovery = MemberModel::withTrashed();
            if ($recovery->restore()) {
                return response()->json(['code' => 200, 'message' => '全部恢复成功']);
            } else {
                return response()->json(['code' => 500, 'message' => '恢复失败']);
            }
        }

    }

    //再已删除的客户中筛选
    public function seach_name(Request $request)
    {
        $data = $request->all();
        $username = $data['seach_name'];
        if ($username == null) {
            $table = MemberModel::onlyTrashed()->get();
            return view('home/member/member_del', ['title' => '客户删除列表', 'table' => $table, 'count' => $table->count()]);
        } else {
            $table = MemberModel::onlyTrashed()->where('username', $username)->get();
            return view('home/member/member_del', ['title' => '客户删除列表', 'table' => $table, 'count' => $table->count()]);
        }

    }
}