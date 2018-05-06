<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    //使用软删除技术
    use SoftDeletes;

    //绑定表
    protected $table = 'customer';
}
