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
                if ($users['deleted_at'] != null){
                    return response() -> json(['status' => 1 , 'message' => '该用户不存在，请检查用户名']);
                }else{
                    if ($users -> username == $data['username'] && $users -> password == md5($data['password'])){
                        if ($users -> status == 1){
                            return response() -> json(['status' => 1 , 'message' => '该账号已被禁用，请联系管理员']);
                        }else{
                            session() -> put([
                                'username' =>$users -> username ,
                                'password' => $users -> password,
                                'id' => $users -> id
                            ]);
                            return response() -> json(['status' => 0 , 'message' => '登录成功']);
                        }
                    }else{
                        return response() -> json(['status' => 1 , 'message' => '用户名或者密码不正确，请检查']);
                    }
                }
            }
       }
    }

    //退出登录
    public function logout()
    {
        session() -> forget('username');
        session() -> forget('password');
        session() -> forget('id');
        session() -> flush();
        return redirect('home');
    }

    //渲染登录主页
    public function welcome()
    {
        return view('home/welcome');
    }





}