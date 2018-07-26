<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function teacher_subject(){

        return $this->belongsTo('App\Teacher_subject','subjects_id');
    }
}
