<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthTips extends Model
{
    protected $guarded = [];
    public function HealthTipsCategory()
    {
        return $this->belongsTo('App\HealthTipsCategory','health_tips_category_id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id');
    }
}
