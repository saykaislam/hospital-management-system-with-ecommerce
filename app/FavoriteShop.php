<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteShop extends Model
{
    public function shop()
    {
        return $this->belongsTo('App\Shop','shop_id');
    }
}
