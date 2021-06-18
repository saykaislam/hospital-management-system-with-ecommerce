<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    protected $guarded = [];
    public function subcategory() {
        return $this->belongsTo('App\SubCategory','sub_category_id');
    }
}
