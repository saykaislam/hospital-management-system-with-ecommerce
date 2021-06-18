<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicDoctor extends Model
{
    public function clinic(){
        return $this->belongsTo('App\Clinic');
    }
    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }
}
