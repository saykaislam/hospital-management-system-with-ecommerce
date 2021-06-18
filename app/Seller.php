<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->hasOne('App\Shop','seller_id');
    }
}
