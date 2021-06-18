<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopBrand extends Model
{
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id');
    }
}
