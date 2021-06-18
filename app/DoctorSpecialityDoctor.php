<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialityDoctor extends Model
{
    public function doctorSpeciality(){
        return $this->belongsTo('App\DoctorSpeciality');
    }
}
