<html lang="zh-cn">
<head>
    <title></title>
</head>
<body>

快递公司：{{$shippername}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;快递单号：{{$number}}
<br>
<br>
@foreach($table as $table)
    {{$table -> AcceptTime}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$table -> AcceptStation}}
    <br>
@endforeach


</body>
</html>