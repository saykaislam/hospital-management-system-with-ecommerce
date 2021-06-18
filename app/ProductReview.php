<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $guarded = [];
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function shop() {
        return $this->belongsTo('App\Shop','shop_id');
    }
    public function product() {
        return $this->belongsTo('App\Product','product_id');
    }
}
