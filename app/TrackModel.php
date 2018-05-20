<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrackModel extends Model
{
    use SoftDeletes;
    //绑定表
    protected $table = 'track';

    protected $primaryKey ='id';

    //设置日期显示格式
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }
}
