<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersModel extends Model
{
    //使用软删除
    use SoftDeletes;

    //绑定表
    protected $table = 'user';

    //设置主键
    protected $primaryKey='id';

    protected $dates = ['deleted_at'];

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

}
