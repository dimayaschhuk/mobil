<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_subject extends Model
{
    public function teacher()
    {
        return $this->belongsToMany('App\User', 'users_id');
    }





    public function subject()
    {
        return $this->hasOne('App\Subject', 'id');
    }

    public function schedule()
    {
        return $this->hasMany('App\Schedule','teacher_subjects_id');
    }
}
