<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function clinicCategory()
    {
        return $this->belongsTo('App\ClinicCategory');
    }

    public function clinicContact()
    {
        return $this->hasOne('App\ClinicContact','clinic_id');
    }
}
