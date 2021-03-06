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
        <a href="javascript:">售后管理</a>
        <a>
          <cite>售后列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href = '{{url('home/customer_list')}}');" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" id="seach_member" name="seach_member" method="get">
            <input type="text" name="seach_user" id="seach_user" placeholder="请输入用户名" autocomplete="off"
                   class="layui-input">
            <button class="layui-btn" id="seach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加售后订单','{{url('home/customer_add')}}',600,400)"><i
                    class="layui-icon"></i>添加
        </button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>售后编号</th>
            <th>客户姓名</th>
            <th>客户手机</th>
            <th>客户地址</th>
            <th>售后内容</th>
            <th>售后状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($table as $table)
                <td>{{$table -> customer_id}}</td>
                <td>{{$table -> name}}</td>
                <td>{{$table -> mobile}}</td>
                <td>{{$table -> address}}</td>
                <td>{{$table -> context}}</td>
                <td>{{$table -> status}}</td>
                <td>{{date("Y/m/d H:i:s",$table -> create_at)}}</td>
            <td class="td-manage">
                @if($table -> status == '未完结')
                <a title="编辑" onclick="x_admin_show('编辑','{{url('home/customer_edit/id='.$table -> id)}}',600,400)"
                   href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$table -> id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
                @else
                    不可编辑
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',{
            btn:['确定','取消'],
            btn1:function (index,layero) {
                $.ajaxSetup({
                   headers:{'X-CSRF-TOKEN':'{{csrf_token()}}'}
                });
                $.ajax({
                    type:'POST',
                    url: '{{url('home/del_customer')}}',
                    data:{
                        id:id
                    },
                    dataType:'json',
                    success:function (response) {
                        if (response.code == 200){
                            layer.msg('已删除', {
                                icon: 6, time: 800, end: function () {
                                    layer.close(index);
                                    location.href = '{{url('home/customer_list')}}';
                                }})
                        } else{
                            layer.msg('删除失败',{icon:5,time:1000});
                        }
                    }
                })
            }
        });
    }



</script>

</body>

</html>