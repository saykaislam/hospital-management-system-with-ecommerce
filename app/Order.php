<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderServiceDetail()
    {
        return $this->hasOne('App\OrderServiceDetail');
    }

    public function serviceProvider()
    {
        return $this->belongsTo('App\ServiceProvider');
    }

    public function orderProductDetail()
    {
        return $this->hasOne('App\OrderDetails');
    }



    public function order_details()
    {
        return $this->hasOne('App\OrderDetails', 'order_id');

    }
    public function OrderTempCommission()
    {
        return $this->hasOne('App\OrderTempCommission', 'order_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');

    }
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id');

    }
}
