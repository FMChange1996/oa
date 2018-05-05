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

    //设置主键
    protected $primaryKey = 'id';

    //设置软删除时间
    protected $dates = ['delete_at'];

    //设置日期显示格式
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }

    protected function getOrder_payAttr($value)
    {
        $order_pay = [
            0 => '未确认',
            1 => '已确认'
        ];
        return $order_pay[$value];
    }
}
