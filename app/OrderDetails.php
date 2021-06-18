<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $guarded = [];
    public function order() {
        return $this->belongsTo('App\Order','order_id');
    }
    public function productStock()
    {
        return $this->belongsTo('App\ProductStock', 'variation_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
