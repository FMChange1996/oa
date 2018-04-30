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
        <a href="">首页</a>
        <a href="">管理员</a>
        <a>
          <cite>管理员列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{url('home/admin_add')}}')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>登录名</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>角色</th>
            <th>加入时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($table as $table)
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>

            <td>{{$table -> id}}</td>
            <td>{{$table -> username}}</td>
            <td>{{$table -> mobile}}</td>
            <td>{{$table -> mail}}</td>
            @if($table -> role == 0)
                <td>超级管理员</td>
            @else
                <td>管理员</td>
            @endif
            <td>{{date("Y/m/d H:i:s",$table -> create_time)}}</td>

            <td class="td-status">
                @if($table -> status == 0)
                    <span class="layui-btn layui-btn-mini">已启用</span>
                @else
                    <span class="layui-btn layui-btn-danger layui-btn-mini">已停用</span>
                @endif
            </td>
            @if (Session::get('username') == 'admin')
            <td class="td-manage">
                @if($table ->status == 0)
                <a onclick="member_stop(this,'{{$table -> id}}')" href="javascript:;"  title="启用">
                    <i class="layui-icon">&#xe601;</i>
                </a>
                @else
                <a onclick="member_stop(this,'{{$table -> id}}')" href="javascript:;"  title="停用">
                    <i class="layui-icon">&#xe62f;</i>
                </a>
                @endif
                <a title="编辑" onclick="x_admin_show('编辑','{{url('home/admin_edit/id='.$table->id)}}')"
                   href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" onclick="member_del(this,'{{$table -> id}}')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
            @else
            <td class="td-manage">
                <a title="编辑" onclick="x_admin_show('编辑','{{url('home/admin_edit/id='.$table->id)}}')"
                   href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
            </td>
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        $.ajax({
            type: 'GET',
            url: '{{url('home/users_status')}}',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                if (response.code == 200) {
                    if (response.status == 0) {
                        layer.confirm('确定要停用吗', {
                            btn: ['确定', '取消'],
                            btn1: function (index, layero) {
                                $.ajaxSetup({
                                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: '{{url('/home/change_status')}}',
                                    data: {
                                        id: id,
                                        status: 1
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response.code == 200) {
                                            layer.close(index);
                                            $(obj).attr('title', '停用')
                                            $(obj).find('i').html('&#xe62f;');
                                            $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                                            layer.msg('已停用!', {icon: 5, time: 1000});
                                            location.href = "{{url('home/admin_list/username='.Session::get('username'))}}";
                                        } else {
                                            layer.msg(response.message,{icon:5,time:3000});
                                        }
                                    },
                                    error:function () {
                                        
                                    }
                                })
                            }
                        });
                    } else {
                        layer.confirm('确定要启用吗', {
                            btn: ['确定', '取消'],
                            btn1: function (index, layero) {
                                $.ajaxSetup({
                                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: '{{url('/home/change_status')}}',
                                    data: {
                                        id: id,
                                        status: 0
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response.code == 200) {
                                            layer.close(index);
                                            $(obj).attr('title', '启用')
                                            $(obj).find('i').html('&#xe601;');
                                            $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                                            layer.msg('已启用!', {icon: 6, time: 1000});
                                            location.href = "{{url('home/admin_list/username='.Session::get('username'))}}";
                                        } else {

                                        }
                                    }
                                })
                            }
                        });
                    }
                } else {
                    layer.msg('获取用户信息失败！', {icon: 5, time: 3000})
                }
            }

            });


    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',{
            btn:['确定','取消'],
            btn1:function(index,layero){
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                });
                $.ajax({
                    type:'POST',
                    url:'{{url('home/delete_user')}}',
                    data:{
                        id:id
                    },
                    dataType:'json',
                    success:function (response) {
                        if (response.code == 200){
                            layer.close(index);
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:6,time:500,end:function () {
                                    location.href = "{{url('home/admin_list/username='.Session::get('username'))}}";
                                }});


                        } else{
                            layer.msg('删除失败!',{icon:5,time:1000});
                        }
                        
                    }
                });

            }
        });
    }



    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
</body>

</html>