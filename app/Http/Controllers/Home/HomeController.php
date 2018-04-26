<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

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
        $res = $request -> all();
        $username = $res['username'];
        $password = md5($res['password']);
        $pass =DB::table('user') -> where('username',$username) -> first();
        $username1 = $pass -> username;
        $password1 = $pass -> password;
        if ($username1 == $username && $password1 == $password){
            $request -> session() -> put(['username' => $username ,'password' => $password ]);
            return response() -> json(['status' => 0 , 'message' => '登录成功']);
        }else{
            return response() -> json(['status' => 1 , 'message' => '用户名或密码错误']);
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
        $table =DB::table('user') -> get();
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

        $status = 0;
        $message = [
            'username' => '用户名不可为空',
            'password' => '密码不符合要求或为空',
            'repassword' => '确认密码不可为空',
            'mobile' => '手机号为空或格式不符要求',
            'mail' => '邮箱为空或格式不符要求',
            'role' => '用户角色不可为空',
            'status' => '用户状态不可为空'
        ];

        $rule = [
            'username' => 'required',
            'passwrod' => 'required|mix:6|max:16',
            'repassword' => 'required|mix:6|max:16',
            'mobile' => 'required|mix:11|max:12',
            'mail' => 'required|mail',
            'role' => 'required',
            'status' => 'required'
        ];
         $validator = Validator::make($request -> all(),$rule,$message) -> validate();

         echo $validator;
    }
}