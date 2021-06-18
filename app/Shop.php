<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function shopCategories()
    {
        return $this->hasMany('App\ShopCategory','shop_id');
    }
    public function seller()
    {
        return $this->belongsTo('App\Seller','seller_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
