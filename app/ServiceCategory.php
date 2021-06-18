<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $guarded = [];
    public function serviceSubCategory()
    {
        return $this->hasMany('App\ServiceSubCategory','service_category_id');
    }

    public function serviceProviderCategory(){
        return $this->belongsTo('App\ServiceProviderCategory');
    }
}
