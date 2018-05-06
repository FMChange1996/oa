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
        <a href="javascript">订单管理</a>
        <a>
          <cite>订单列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input type="text" name="username"  placeholder="请输入订单号" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加订单','{{url('home/order_add')}}')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>订单编号</th>
            <th>收货人</th>
            <th>手机号</th>
            <th>收件地址</th>
            <th>购买物品</th>
            <th>订单状态</th>
            <th>支付金额</th>
            <th>发货状态</th>
            <th>支付方式</th>
            <th>配送方式</th>
            <th>物流单号</th>
            <th>下单时间</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($table as $table)
        <tr>
            <td>{{$table -> id}}</td>
            <td>{{$table -> order_id}}</td>
            <td>{{$table -> name}}</td>
            <td>{{$table -> mobile}}</td>
            <td>{{$table -> address}}</td>
            <td>{{$table -> goods}}</td>
            <td>{{$table -> order_status}}</td>
            <td>{{$table -> order_money}}</td>
            <td>{{$table -> send_status}}</td>
            @if($table -> order_pay == 0)
                <td>支付宝</td>
            @elseif($table -> order_pay == 1)
                <td>微信支付</td>
            @else
                <td>货到付款</td>
            @endif
            <td>{{$table -> shipping}}</td>
            <td>{{$table -> shiping_num}}</td>
            <td>{{date("Y/m/d H:i:s",$table -> create_at)}}</td>
            <td class="td-manage">
                <a title="查看" onclick="x_admin_show('编辑','{{url('home/order_edit')}}')" href="javascript:;">
                    <i class="layui-icon">&#xe63c;</i>
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
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？', {
            btn: ['确认', '取消'],
            btn1: function (index, layero) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
                });
                $.ajax({
                    type: 'POST',
                    url: '{{url('')}}',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.code == 200) {
                            layer.msg(response.message, {
                                icon: 6, time: 600, end: function () {
                                    layer.close(index);
                                    location.href = "{{url('home/order_list')}}"
                                }
                            })
                        } else {
                            layer.msg(response.message, {icon: 5, time: 1000});
                        }
                    }

                })
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