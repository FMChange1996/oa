<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberModel extends Model
{
    //使用软删除技术
    use SoftDeletes;

    //绑定表
    protected $table = 'member';

    //设置主键
    protected $primaryKey = 'id';

    //设置软删除时间
    protected $dates = ['delete_at'];

    //设置日期显示格式
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }


}
