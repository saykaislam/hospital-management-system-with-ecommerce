<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSubCategory extends Model
{
    protected $guarded = [];

    public function serviceCategory()
    {
        return $this->belongsTo('App\ServiceCategory', 'service_category_id');
    }
}
