<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedQuestion extends Model
{
    public function doctorSpeciality(){
        return $this->belongsTo('App\DoctorSpeciality');
    }
}
