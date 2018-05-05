<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model
{
    //使用软删除方法
    use SoftDeletes;

    //绑定表
    protected $table = 'order';


}
