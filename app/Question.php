<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function doctorSpeciality(){
        return $this->belongsTo('App\DoctorSpeciality');
    }

    public function questionAnswer(){
        return $this->hasOne('App\QuestionAnswer');
    }
}
