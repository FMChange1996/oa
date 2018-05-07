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
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="login">
        <hr class="hr20" >
    </form>
</div>


<script>
    //
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


</script>


</body>
</html>