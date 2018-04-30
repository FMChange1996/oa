<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    //渲染
    public function admin_rule()
    {
        return view('home/admin_rule');
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

    public function admin_role()
    {
        return view('home/admin_role');
    }

    public function admin_cate()
    {
        return view('home/admin_cate');
    }

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

    public function users_status(Request $request)
    {
        $id = $request->all();
        $status = UsersModel::where('id', $id) -> first(['status']);
        return response()->json(['code' => 200, 'status' => $status -> status]);


    }
}