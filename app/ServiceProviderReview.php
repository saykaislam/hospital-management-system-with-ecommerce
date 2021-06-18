<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderReview extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function serviceProvider()
    {
        return $this->belongsTo('App\ServiceProvider');
    }
}
