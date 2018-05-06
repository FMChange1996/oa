<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
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
    <form class="layui-form" name="edit" id="edit_member">
        <div class="layui-form-item">
            <label for="customer_id" class="layui-form-label">
                <span class="x-red">*</span>售后编号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="customer_id" name="customer_id" value="{{$table -> customer_id}}"
                       autocomplete="off" class="layui-input" disabled="disabled">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>客户姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="username" value="{{$table -> name}}"
                       autocomplete="off" class="layui-input" disabled="disabled">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="mobile" class="layui-form-label">
                <span class="x-red">*</span>手机号
            </label>
            <div class="layui-input-inline">
                <input type="trext" id="mobile" name="mobile" value="{{$table -> mobile}}"
                       autocomplete="off" class="layui-input" disabled="disabled">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="address" class="layui-form-label">
                <span class="x-red">*</span>地址
            </label>
            <div class="layui-input-inline">
                <textarea class="layui-textarea" name="address" placeholder="请输入地址" disabled="disabled">{{$table -> address}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="address" class="layui-form-label">
                <span class="x-red">*</span>售后内容
            </label>
            <div class="layui-input-inline">
                <textarea class="layui-textarea" name="context">{{$table -> context}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="address" class="layui-form-label">
                <span class="x-red">*</span>售后状态
            </label>
            <div class="layui-input-inline">
                <select name="status">
                    @if($table -> status == 0)
                    <option value="0">未完结</option>
                    <option value="1">已完结</option>
                    @else
                    <option disabled>已完结</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="submit" class="layui-form-label">
            </label>
            <input type="hidden" id="id" name="id" class="layui-input" value="{{$table -> id}}">
            <input type="button" class="layui-btn" id="edit" value="保存">
        </div>
    </form>
</div>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
        });
        $('#edit').on('click', function (event) {
            $.ajax({
                type: 'POST',
                url: '{{url('home/update_customer')}}',
                data: $('#edit_member').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.code == 200) {
                        layer.msg(response.message,{icon:6,time:600,end:function () {
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                                window.parent.location.replace("{{url('home/customer_list')}}");
                            }})
                    } else {
                        layer.msg(response.message,{icon:5,time:1000});
                    }
                }
            });
        });
    });

</script>
</body>

</html>