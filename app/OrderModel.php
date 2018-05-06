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

    public function getOrderPayAttribute($value)
    {
        $order_pay = [
            0 => '支付宝',
            1 => '微信',
            3 => '货到付款'
        ];
        return $order_pay[$value];
    }

    public function getSendStatusAttribute($value)
    {
        $send_status = [
            0 => '未发货',
            1 => '已发货'
        ];
        return $send_status[$value];
    }

    public function getOrderStatusAttribute($vlue)
    {
        $order_status = [
            0 => '未发货',
            1 => '已发货'
        ];

        return $order_status[$vlue];
    }


}
