<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackModel extends Model
{
    //绑定表
    protected $table = 'track';

    protected $primaryKey ='id';

    //设置日期显示格式
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }
}
