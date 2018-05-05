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
<div class="x-body">
    <form class="layui-form" name="order" id="order">
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="x-red">*</span>收货人
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" required=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="mobile" class="layui-form-label">
                <span class="x-red">*</span>手机
            </label>
            <div class="layui-input-inline">
                <input type="text" id="mobile" name="mobile" required=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="address" class="layui-form-label">
                <span class="x-red">*</span>收货地址
            </label>
            <div class="layui-input-inline">
                <textarea name="address" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="order_pay" class="layui-form-label">
                <span class="x-red">*</span>支付方式
            </label>
            <div class="layui-input-inline">
                <select name="order_pay">
                    <option>请选择</option>
                    <option value="0">支付宝</option>
                    <option value="1">微信</option>
                    <option value="2">货到付款</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                配送物流
            </label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="shipping" id="shipping" autocomplete="off">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>购买物品
            </label>
            <div class="layui-input-inline">
                <textarea placeholder="请输入内容" id="goods" name="goods" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="button" class="layui-btn" value="增加订单" id="save_order">
        </div>
    </form>
</div>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
        });
        $('#save_order').on('click', function (event) {
            $.ajax({
                type: 'POST',
                url: '{{url('home/add_order')}}',
                data: $('#order').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (responde.code == 200) {
                        layer.msg(response.message, {
                            icon: 6, time: 600, end: function () {
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                                window.parent.location.replace("{{url('home/order_list')}}");
                            }
                        });
                    } else {
                        layer.msg(response.message, {icon: 5, time: 1000});
                    }
                }
            });
        });
    });
</script>
</body>

</html>