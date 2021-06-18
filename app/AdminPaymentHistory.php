<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPaymentHistory extends Model
{
    protected $guarded = [];
    public function seller()
    {
        return $this->belongsTo('App\Seller', 'seller_id');
    }
}
