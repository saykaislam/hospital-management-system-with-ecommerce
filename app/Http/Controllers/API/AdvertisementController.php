<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Advertisement;
use App\Order;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function getAdvertisements() {
        $advertisements = Advertisement::all();
        if (!empty($advertisements))
        {
            return response()->json(['success'=>true,'response'=> $advertisements], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
}
