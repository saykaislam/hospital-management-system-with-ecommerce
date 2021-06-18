<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodBank extends Model
{
    protected $guarded = [];
    public function clinic()
    {
        return $this->belongsTo('App\User','clinic_id');
    }
}
