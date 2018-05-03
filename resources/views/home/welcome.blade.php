<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{URL::asset('css/font.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/xadmin.css')}}">
    {{--{{date_default_timezone_set('PRC')}}--}}
</head>
<body>
<div class="x-body">
    <fieldset class="layui-elem-field">
        <legend>系统信息</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <thead>
                <tr>
                    <th colspan="2" scope="col">当前系统信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th width="30%">当前用户登录名</th>
                    <td>{{Session::get('username')}}</td>
                </tr>
                <tr>
                    <td>客户端IP地址</td>
                    <td>{{Request::getClientIp()}}</td>
                </tr>
                <tr>
                    <td>域名</td>
                    <td>{{$_SERVER["HTTP_HOST"]}}</td>
                </tr>
                <tr>
                    <td>操作系统 </td>
                    <td>{{PHP_OS}}</td>
                </tr>
                <tr>
                    <td>PHP版本 </td>
                    <td>{{PHP_VERSION}}</td>
                </tr>
                <tr>
                    <td>当前时间 </td>
                    <td>{{date('Y-m-d H:i:s',time())}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
</body>
</html>