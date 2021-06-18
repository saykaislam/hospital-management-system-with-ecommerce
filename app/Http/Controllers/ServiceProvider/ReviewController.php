<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use App\ServiceProviderReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index(){
        $reviews = DB::table('service_provider_reviews')
            ->join('service_providers','service_provider_reviews.service_provider_id','=','service_providers.id')
            ->where('service_providers.user_id', Auth::user()->id)
            ->select('service_provider_reviews.*')
            ->get();

        return view('backend.service_provider.review',compact('reviews'));

    }
}
