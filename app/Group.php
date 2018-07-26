<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function student()
    {
        return $this->hasMany('App\Student', 'groups_id');
    }




    public function schedule()
    {
        return $this->hasMany('App\Schedule','id');
    }


}
