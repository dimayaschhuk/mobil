<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visiting extends Model
{
    public function student(){

        return $this->belongsTo('App\Student','id');
    }
}
