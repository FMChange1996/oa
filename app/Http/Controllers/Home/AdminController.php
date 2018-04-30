<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AdminController extends Controller
{

    //渲染管理员编辑模板
   public function admin_edit($id)
   {
       $response = UsersModel::where('id',$id) ->first();
       return view('home/admin_edit',['title' => '管理员编辑','table' => $response]);
   }

    //添加管理员
    public function add_user(Request $request)
    {
        $data = $request -> all();
        $messages = [
            'username.required' => '用户名不可为空',
            'password.required' => '密码不能为空',
            'password.min' => '密码不可小于6位',
            'repassword.required' => '确认密码不可为空',
            'mobile.required' => '手机号不可为空',
            'mobile.min' => '手机号格式不对',
            'mail.required' => '邮箱账号不可为空',
            'mail.email' => '邮箱账号格式不正确',
            'role.required' => '请选择用户角色',
            'status.required' => '请选择用户状态'
        ];
        //验证用户输入
        $validate = Validator::make($data, [
            'username' => 'required',
            'password' => 'required|min:6',
            'repassword' => 'required|min:6',
            'mobile' => 'required|min:6',
            'mail' => 'required|email',
            'role' => 'required',
            'status' => 'required'
        ], $messages);

        //判断验证
        if ($validate->fails()) {
            return response()->json(['status' => 1, 'message' => $validate->errors()->first()]);
        } else {
            //判断数据库中是否存在该用户
            $res = UsersModel::where('username', $data['username'])->first();
            if ($res == null) {
                $respone = UsersModel::insert([
                    'username' => $data['username'],
                    'password' => md5($data['password']),
                    'mobile' => $data['mobile'],
                    'mail' => $data['mail'],
                    'role' => $data['role'],
                    'status' => $data['status'],
                    'create_time' => $data['create_time']
                ]);
                if ($respone == true) {
                    return response()->json(['status' => 0, 'message' => '创建成功']);
                } else {
                    return response()->json(['status' => 1, 'message' => '创建失败']);
                }
            } else {
                return response()->json(['status' => 1, 'message' => '该用户已存在']);
            }

        }
    }

    //渲染添加管理员页面
    public function admin_add()
    {
        return view('home/admin_add',['title' => '管理员添加']);
    }

    //渲染管理员模板
    public function admin_list($username)
    {
        if ($username == 'admin'){
            $table =UsersModel::all();
            return view('home/admin_list',['title' => '管理员列表','table' => $table , 'count' => $table ->count()]);
        }else{
            $table =UsersModel::where('username',$username) -> get();
            return view('home/admin_list',['title' => '管理员列表','table' => $table , 'count' => $table ->count()]);
        }

    }

    //使用软删除方法删除用户
    public function delete_user(Request $request)
    {
        $data = $request -> all();
        $up = UsersModel::find($data['id']);
        $up -> status = 1;
        if ($up -> save()){
            $del = UsersModel::find($data['id']);
            $del -> delete();
            if ($del -> trashed()){
                return response() -> json(['code' => 200]);

            }else{
                return response() -> json(['code' => 500]);
            }
        }
    }

    //改变用户当前状态
    public function change_status(Request $request)
    {
        $data = $request -> all();
        $response = UsersModel::where('id',$data['id']) -> first(['status','username']);
        if ($response -> username == 'admin'){
            return response() -> json(['code' => 500 , 'message' => '超级管理员账户不可被停用']);
        }else{
            $res = UsersModel::find($data['id']);
            $res -> status = $data['status'];
            if ($res -> save()){
                return response() -> json(['code' => 200]);
            }else{
                return response() -> json(['code' => 500 , 'message' => '更改失败！']);
            }
        }

    }

    //获取用户当前状态
    public function users_status(Request $request)
    {
        $id = $request->all();
        $status = UsersModel::where('id', $id) -> first(['status']);
        return response()->json(['code' => 200, 'status' => $status -> status]);
    }

    //更改用户信息
    public function change_user(Request $request)
    {
        $data = $request -> all();
        $message = [
            'password.required' => '密码不能为空',
            'mail.required' => '邮箱不能为空',
            'mail.email' => '邮箱格式不正确',
            'mobile.required' => '手机号不能为空',
            'mobile.min' => '手机号格式不正确',
        ];

        $validate = Validator::make($data,[
            'password' => 'required',
            'mail' => 'required|email',
            'mobile' => 'required|min:11'
        ],$message);

        if ($validate -> fails()){
            return response() -> json(['status' => 1 , 'message' => $validate -> errors() -> first()]);
        }else{
            $password1 = UsersModel::where('id',$data['id']) -> first();
            if ($password1-> password == md5($data['password'])){
                $req = UsersModel::find($data['id']);
                $req -> mail = $data['mail'];
                $req -> mobile = $data['mobile'];
                if ($req ->save()){
                    return response() -> json(['status' => 0 , 'message' => '保存成功']);
                }else{
                    return response() -> json(['status' => 1 , 'message' => '保存失败']);
                }
            }else{
                $req = UsersModel::find($data['id']);
                $req -> password = md5($data['password']);
                $req -> mail = $data['mail'];
                $req -> mobile = $data['mobile'];
                if ($req -> save()){
                    session() -> forget('username');
                    session() -> forget('password');
                    session() -> forget('id');
                    session() -> flush();
                    return response() -> json(['status' => 0 , 'message' => '保存成功，请使用新密码登录']);
                }else{
                    return response() -> json(['status' => 1 , 'message' => '保存失败' ]);
                }
            }
        }

    }

    //恢复所有软删除用户
    public function recovery_user(Request $request)
    {
        $data = $request -> all();
        if ($data['code'] == 200){
            $recovery = UsersModel::withTrashed();
            if ($recovery -> restore()){
                return response() -> json(['code' => 200]);
            }else{
                return response() -> json(['code' => 500]);
            }
        }else{
            pass;
        }
    }
}