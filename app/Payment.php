<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    public function seller()
    {
        return $this->belongsTo('App\Seller', 'seller_id');
    }
}
