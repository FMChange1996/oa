<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{URL::asset('css/font.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/xadmin.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/KDNWidget.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('js/KDNWidget.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{url('home/index')}}">首页</a>
        <a href="javascript::">系统管理</a>
        <a>
          <cite>系统日志</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>操作人</th>
            <th>事件</th>
            <th>时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tables as $table)
            <tr>
                <td>{{$table -> id}}</td>
                <td>{{$table -> username}}</td>
                <td>{{$table -> context}}</td>
                <td>{{$table -> time}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
<div class="page">
    <div>
        {{  $tables -> links()}}
    </div>
</div>
</body>

</html>