<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function member_list()
    {
        return view('home/member/member_list', ['title' => '客户列表']);
    }

    public function member_del()
    {
        return view('home/member/member_del');
    }

    public function member_add()
    {
        return view('home/member/member_add', ['title' => '客户添加']);
    }
}