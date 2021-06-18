<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function serviceProviderCategory()
    {
        return $this->belongsTo('App\ServiceProviderCategory');
    }

    public function serviceCategory()
    {
        return $this->belongsTo('App\ServiceCategory');
    }

    public function serviceSubCategory()
    {
        return $this->belongsTo('App\ServiceSubCategory');
    }
}
