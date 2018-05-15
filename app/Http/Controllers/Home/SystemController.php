<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\SytemModel;

class SystemController extends Controller
{
    //渲染系统日志列表
    public function log_list()
    {
        $table = SytemModel::paginate(15);
        return view('home/system/log',['title' => '系统日志','tables' => $table , 'count' => $table -> count() ]);
    }

}