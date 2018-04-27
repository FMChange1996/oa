<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    //绑定表
    protected $table = 'user';

    protected $primaryKey='id';


}
