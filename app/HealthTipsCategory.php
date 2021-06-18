<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthTipsCategory extends Model
{
    protected $guarded = [];
    public function posts()
    {
        return $this->hasMany('App\HealthTips','health_tips_category_id');
    }
}
