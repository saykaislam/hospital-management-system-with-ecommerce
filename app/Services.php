<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $guarded = [];

    public function serviceProviderCategory(){
        return $this->belongsTo('App\ServiceProviderCategory', 'service_provider_category_id');
    }
    public function serviceCategory(){
        return $this->belongsTo('App\ServiceCategory', 'service_category_id');
    }

    public function ServiceSubCategory(){
        return $this->belongsTo('App\ServiceSubCategory', 'service_sub_category_id');
    }

    public function divisionDistrict(){
        return $this->belongsTo('App\DivisionDistrict');
    }
}
