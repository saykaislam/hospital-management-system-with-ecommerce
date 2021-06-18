<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    public function test()
    {
        return $this->belongsTo('App\Test');
    }
    public function lab()
    {
        return $this->belongsTo('App\User','clinic_or_lab_user_id');
    }
}
