<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemModel extends Model
{
    //
    protected  $table = 'logs';

    //设置日期显示格式
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }

}
