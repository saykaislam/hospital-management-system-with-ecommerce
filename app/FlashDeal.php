<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    public function flashDealProducts()
    {
        return $this->hasMany('App\FlashDealProduct','flash_deal_id');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop','shop_id');
    }
}
