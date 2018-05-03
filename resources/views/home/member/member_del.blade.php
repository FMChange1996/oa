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
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('lib/layui/layui.js')}}" charset="utf-8"></script>
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
        <a href="javascript:">客户管理</a>
        <a>
          <cite>客户删除</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" method="get" action="{{url('home/seach_name')}}">
            <input type="text" name="seach_name" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="recAll()"><i class="layui-icon"></i>批量恢复</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>性别</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>地址</th>
            <th>加入时间</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($table as $table)
        <tr>
            <td>{{$table ->id}}</td>
            <td>{{$table -> username}}</td>
            @if($table -> sex == 0)
            <td>男</td>
            @else
                <td>女</td>
            @endif
            <td>{{$table -> mobile}}</td>
            <td>{{$table -> mail}}</td>
            <td>{{$table -> address}}</td>
            <td>{{date('Y/m/d H:i:s',$table -> create_at)}}</td>
            <td class="td-manage">
                <a title="恢复" onclick="member_rec(this,'{{$table -> id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe618;</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$table -> id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
<script>

    /*用户-恢复*/
    function member_rec(obj, id) {
        layer.confirm('确认要恢复吗？', {
            btn: ['确定', '取消'],
            btn1: function (index, layero) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
                });
                $.ajax({
                    type: 'POST',
                    url: '{{url('home/recovery_member')}}',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.code == 200) {
                            layer.msg(response.message, {
                                icon: 6, time: 600, end: function () {
                                    location.href = '{{url('home/member_del')}}'
                                }
                            })
                        } else {
                            layer.msg(response.message, {icon: 5, time: 1000});
                        }
                    }
                });
            }
        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？', {
            btn: ['确定', '取消'],
            btn1: function (index, layero) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
                });
                $.ajax({
                    type: 'POST',
                    url: '{{url('home/delete_member')}}',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.code == 200) {
                            layer.msg(response.message, {
                                icon: 6, time: 600, end: function () {
                                    location.href = '{{url('home/member_del')}}'
                                }
                            })
                        } else {
                            layer.msg(response.message, {icon: 5, time: 1000});
                        }
                    }
                });
            }
        });
    }


    function recAll(argument) {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
        });
        $.ajax({
            type: 'POST',
            url: '{{url('home/recover_all')}}',
            data: {
                code: 200
            },
            dataType: 'json',
            success: function (response) {
                if (response.code == 200) {
                    layer.msg(response.message, {
                        icon: 6, time: 600, end: function () {
                            location.href = '{{url('home/member_del')}}'
                        }
                    })
                } else {
                    layer.msg(response.message, {icon: 5, time: 1000});
                }
            }
        });
    }
</script>
</body>

</html>