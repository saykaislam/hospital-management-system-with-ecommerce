<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function DoctorSpeciality()
    {
        return $this->belongsTo('App\DoctorSpeciality','doctor_speciality_id');
    }

    public function DoctorContact(){
        return $this->hasOne('App\DoctorContact');
    }
}
