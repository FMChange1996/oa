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

    //绑定主键
    protected $primaryKey = 'id';

    public function getStatusAttribute($value)
    {
        $status = [
            0 => '未完结',
            1 => '已完结'
        ];
        return $status[$value];
    }
}
