<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{URL::asset('css/font.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{URL::asset('lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('js/xadmin.js')}}"></script>
    <style>
        .vaptcha-init-main {
            display: table;
            width: 100%;
            height: 100%
            background-color: #EEEEEE;
        }
        .vaptcha-init-loading {
            display: table-cell;
            vertical-align: middle;
            text-align: center
        }
        .vaptcha-init-loading>a {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: none;
        }
        .vaptcha-init-loading>a img {
            vertical-align: middle
        }
        .vaptcha-init-loading .vaptcha-text {
            font-family: sans-serif;
            font-size: 12px;
            color: #CCCCCC;
            vertical-align: middle
        }
    </style>
</head>
<body class="login-bg">

<div class="login">
    <div class="message">后台管理系统</div>
    <div id="darkbannerwrap"></div>


    <form method="post" class="layui-form"  name="from" id="from">
        <input name="username" placeholder="用户名"  type="text"  class="layui-input" id="username" >
        <hr class="hr15">
        <input name="password"  placeholder="密码"  type="password" class="layui-input" id="password" >
        <hr class="hr15">
        {{--<div id="vaptcha_container" style="width:300px;height:36px;">--}}
            {{--<!--vaptcha_container是用来引入Vaptcha的容器，下面代码为预加载动画，仅供参考-->--}}
            {{--<div class="vaptcha-init-main">--}}
                {{--<div class="vaptcha-init-loading">--}}
                    {{--<a href="/" target="_blank"><img src="https://cdn.vaptcha.com/vaptcha-loading.gif"/></a>--}}
                    {{--<span class="vaptcha-text">Vaptcha启动中...</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {!! Geetest::render('popup') !!}
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="login">
        <hr class="hr20" >
    </form>
</div>

<script src="https://cdn.vaptcha.com/v.js"></script>
<script>

    //监听提交
    $(document).keyup(function (event) {
       if (event.keyCode == 13){
           $.ajaxSetup({
               headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
           });
           $.ajax({
               type:'POST',
               url:'{{url('home/check')}}',
               data:$('#from').serialize(),
               dataType:'json',
               success:function (response) {
                   if (response.status == 0){
                       layer.msg(response.message,{icon:6,time:3000});
                       window.location.href = "{{url('home/index')}}";
                   } else {
                       layer.msg(response.message,{icon:5,time:2000});
                   }
               }
           });
       }
    });

    //按钮提交
    $(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        //提交信息
        $('#login').on('click',function (event) {
            $.ajax({
                type:'POST',
                url:'{{url('home/check')}}',
                data:$('#from').serialize(),
                dataType:'json',
                success:function (response) {
                    if (response.status == 0){
                        layer.msg(response.message,{icon:6,time:3000});
                        window.location.href = "{{url('home/index')}}";
                    } else {
                        layer.msg(response.message,{icon:5,time:2000});
                    }
                }
            })
        })
    });

    window.onload = function () {
      if (location.href.indexOf('#reloaded') == -1){
          location.href = location.href + '#reloaded';
          parent.location.reload();
      }
    };

    $.get('api/getvaptcha?sceneid=01', function(response){
        console.log(response);
        var options={
            vid: response.data.vid, //验证单元id, string, 必填
            challenge: response.data.challenge, //验证流水号, string, 必填
            container:"#vaptcha_container",//验证码容器, HTMLElement或者selector, 必填
            type:"click", //必填，表示点击式验证模式,
            effect:'float', //验证图显示方式, string, 可选择float, popup, 默认float
            https:false, //协议类型, boolean, 可选true, false
            color:"#57ABFF", //按钮颜色, string
            outage:"/api/vaptcha/downtime", //服务器端配置的宕机模式接口地址
            success:function(token,challenge){//验证成功回调函数, 参数token, challenge 为string, 必填
                //todo:执行人机验证成功后的操作
            },
            fail:function(){//验证失败回调函数
                //todo:执行人机验证失败后的操作
            }
        }
        var obj;
        window.vaptcha(options,function(vaptcha_obj){
            obj = vaptcha_obj;
            obj.init();
        });
    });


</script>


</body>
</html>