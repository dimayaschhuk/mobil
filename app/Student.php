<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function group(){

        return $this->belongsTo('App\Group','id');
    }
    public function visiting(){

        return $this->hasMany('App\Visiting', 'students_id');
    }


}
