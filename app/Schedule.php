<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function group(){

        return $this->belongsTo('App\Group','groups_id');
    }

    public function teacher_subjects()
    {
        return $this->belongsTo('App\Teacher_subject', 'id');
    }


}
