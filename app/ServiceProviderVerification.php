<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderVerification extends Model
{
    public function serviceProvider()
    {
        return $this->belongsTo('App\ServiceProvider');
    }
}
