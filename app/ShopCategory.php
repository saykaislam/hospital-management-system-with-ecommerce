<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id');
    }
}
