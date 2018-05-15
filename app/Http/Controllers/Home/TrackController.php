<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\TrackModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackController extends Controller
{
    //渲染首页
    public function index()
    {
        $table = TrackModel::all();
        return view('home/track/track_list',['title' => '客户跟踪','table' => $table , 'count' => $table ->count()]);
    }

    //添加时间
    public function update_track(Request $request)
    {
        $data = $request -> all();
        $key = $data['key'];
        $find = TrackModel::find($data['id']);
        $find -> $key = $data['time'];
        if ($find -> save()){
            return response() -> json(['status' => 0 , 'message' => '写入数据成功']);
        }else{
            return response() -> json(['status' => 1 , 'message' => '写入数据失败']);
        }

    }

    //获取状态
    public function get_track($id,$key)
    {
        $table = TrackModel::find($id);
        if ($key == 'first_time'){
            $key_name = '第一次跟进';
        }elseif ($key == 'second_time') {
            $key_name = '第二次跟进';
        }else{
            $key_name = '第三次跟进';
        }
        return view('home/track/track_edit',['title' => '获取状态' ,'table' => $table ,'key' => $key , 'key_name' => $key_name]);

    }

    //渲染添加跟踪客户模板
    public function track_add()
    {
        return view('home/track/track_add',['title' => '添加跟踪客户']);
    }

    //添加到数据库
    public function add_track(Request $request)
    {
        $data = $request -> all();
        $message = [
            'wangwang.required' => '旺旺名不能为空'
        ];
        $validate = Validator::make($data,[
            'wangwang' => 'required'
        ],$message);

        if ($validate -> fails()){
            return response() -> json(['status' => 1 , 'message' => $validate -> errors() -> first()]);
        }else{
            $datas =[
                'wangwang' => $data['wangwang'],
                'create_time' => date("Y-m-d",time()),
                'creator' => session() -> get('username')
            ];
            $insert = TrackModel::insert($datas);
            if ($insert == true){
                return response() -> json(['status' => 0 , 'message' => '添加成功']);
            }else{
                return response() -> json(['status' => 1 , 'message' => '添加失败']);
            }
        }
    }

    public function screen_track(Request $request)
    {
        $data = $request -> all();
        $table = TrackModel::where('create_time',$data['screen_time']) -> get();
        return view('home/track/track_list',['title' => '客户跟踪','table' => $table , 'count' => $table ->count()]);

    }

}