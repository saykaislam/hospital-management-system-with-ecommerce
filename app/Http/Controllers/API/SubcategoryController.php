<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public  function getSubcategories()
    {
        $subCategories = SubCategory::all();
        if (!empty($subCategories))
        {
            return response()->json(['success'=>true,'response'=> $subCategories], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
}
