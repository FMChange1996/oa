<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    //渲染登录模板
    public function home()
    {
        return view('home/login');
    }

    //渲染首页模板
    public function index()
    {
        return view('home/index', ['url' => 'welcome']);
    }

    //登录认证
    public function check(Request $request)
    {
        $data = $request -> all();
        $msg = [
            'username.required' => '用户名不可为空',
            'password.required' => '密码不能为空'
        ];
       $validate = Validator::make($data,[
           'username' => 'required',
           'password' => 'required'
       ],$msg);

       if ($validate -> fails()){
           return  response() -> json(['status' => 1 , 'message' => $validate ->errors() ->first()]);
       }else{
            $users = UsersModel::where('username',$data['username']) -> first();
            if ($users == null){
                return response() -> json(['status' => 1 , 'message' => '该用户不存在，请检查用户名']);
            }else{
                if ($users -> username == $data['username'] && $users -> password == md5($data['password'])){
                    session() -> put(['username' =>$users -> username , 'password' => $users -> password]);
                    return response() -> json(['status' => 0 , 'message' => '登录成功']);
                }else{
                    return response() -> json(['status' => 1 , 'message' => '用户名或者密码不正确，请检查']);
                }
            }

       }
    }

    //退出登录
    public function logout()
    {
        session() -> forget('username');
        session() -> forget('password');
        session() -> flush();
        return redirect('home');
    }

    //渲染登录主页
    public function welcome()
    {
        return view('home/welcome');
    }

    public function member_list()
    {
        return view('home/member_list');
    }

    public function member_del()
    {
        return view('home/member_del');
    }

    public function order_list()
    {
        return view('home/order_list');
    }

    public function admin_list()
    {
        $table =UsersModel::all();
        return view('home/admin_list',['title' => '管理员列表','table' => $table , 'count' => $table ->count()]);
    }

    public function order_add()
    {
        return view('home/order_add');
    }

    public function admin_role()
    {
        return view('home/admin_role');
    }

    public function admin_cate()
    {
        return view('home/admin_cate');
    }

    public function admin_rule()
    {
        return view('home/admin_rule');
    }

    public function admin_edit()
    {
        return view('home/admin_edit',['title' => '管理员编辑']);
    }

    //渲染添加管理员页面
    public function admin_add()
    {
        return view('home/admin_add',['title' => '管理员添加']);
    }

    //添加管理员
    public function add_user(Request $request)
    {
        $data = $request->all();
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

        $validate = Validator::make($data, [
            'username' => 'required',
            'password' => 'required|min:6',
            'repassword' => 'required|min:6',
            'mobile' => 'required|min:6',
            'mail' => 'required|email',
            'role' => 'required',
            'status' => 'required'
        ], $messages);

        if ($validate->fails()) {
            return response()->json(['status' => 1, 'message' => $validate->errors()->first()]);
        } else {
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
}