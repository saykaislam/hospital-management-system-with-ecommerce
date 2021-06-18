<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderCost extends Model
{
    public function serviceProvider()
    {
        return $this->hasOne('App\ServiceProvider');
    }
}
