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
        <a href="javascript:">客户跟踪</a>
        <a>
          <cite>跟踪列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href = '{{url('home/track_list')}}');" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" id="seach_member" name="seach_member" method="get" action="{{url('home/screen_track')}}">
            <input type="text" name="screen_time" id="screen_time" placeholder="选择需要筛选的日期" autocomplete="off"
                   class="layui-input">
            <button class="layui-btn" id="seach" ><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加跟踪','{{url('home/track_add')}}',600,400)"><i
                    class="layui-icon"></i>添加
        </button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>旺旺ID</th>
            <th>第一次跟踪时间</th>
            <th>第一次跟踪时间</th>
            <th>第一次跟踪时间</th>
            <th>创建时间</th>
            <th>创建人</th>
        </tr>
        </thead>
        <tbody>
        @foreach($table as $table)
        <tr>
            <td>{{$table -> id}}</td>
            <td>{{$table -> wangwang}}</td>
            @if($table -> first_time == null)
            <td><a onclick="x_admin_show('第一次跟进','{{url('home/get_track/id='.$table -> id.'&key=first_time')}}',600,400)" >跟踪</a></td>
            @else
            <td>{{$table -> first_time}}</td>
            @endif
            @if($table -> second_time == null)
            <td><a onclick="x_admin_show('第二次跟进','{{url('home/get_track/id='.$table -> id.'&key=second_time')}}',600,400)">跟踪</a></td>
            @else
            <td>{{$table -> second_time}}</td>
            @endif
            @if($table -> third_time == null)
            <td><a onclick="x_admin_show('第三次跟进','{{url('home/get_track/id='.$table -> id.'&key=third_time')}}',600,400)">跟踪</a></td>
            @else
            <td>{{$table -> third_time}}</td>
            @endif
            <td>{{$table -> create_time}}</td>
            <td>{{$table -> creator}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div id="test"></div>
</div>
<script>
    layui.use('laydate',function () {
        var laydate = layui.laydate;
        laydate.render({
            elem:'#screen_time',
            done:function (value) {
                document.getElementById('screen_time').value = value;
            }
        });
    });
</script>
</body>

</html>