<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsersModel;
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

        return '123';
//        $data1 = $request -> all();
//        $messages = [
//            'username.required' => '用户名不可为空',
//            'password.required' => '密码不符合要求或为空',
//            'repassword.required' => '确认密码不可为空',
//            'mobile.required' => '手机号不可为空',
//            'mail.required' => '邮箱不可为空',
//            'role.required' => '用户角色不可为空',
//            'status.required' => '用户状态不可为空',
//        ];
//
//        $res= Validator::make($data1,[
//            'username' => 'required',
//            'password' => 'required|mix:6',
//            'repassword' => 'required|mix:6',
//            'mobile' => 'required|mix:11',
//            'mail' => 'required|',
//            'role' => 'required',
//            'status' => 'required',
//            'create_time' => 'required'
//        ],$messages);

        var_dump($res);
//        if ($validate -> fails()){
//            return response() -> json(['status' => 1 ,'message' => $validate ->errors() ->first()]);
//        }else{
//            return response() -> json(['status' => 0, 'message' => '创建成功']);
//        }

    }
}