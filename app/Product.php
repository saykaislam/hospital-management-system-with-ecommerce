<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];
    public function brand() {
        return $this->belongsTo('App\Brand','brand_id');
    }
    public function category() {
        return $this->belongsTo('App\Category','category_id');
    }
    public function subcategory() {
        return $this->belongsTo('App\SubCategory','subcategory_id');
    }
    public function vendor_user() {
        return $this->belongsTo('App\User','vendor_user_id');
    }
    public function stocks(){
        return $this->hasMany("App\ProductStock",'product_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
