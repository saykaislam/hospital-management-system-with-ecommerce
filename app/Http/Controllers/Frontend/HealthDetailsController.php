<?php

namespace App\Http\Controllers\Frontend;

use App\HealthTips;
use App\HealthTipsCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HealthDetailsController extends Controller
{
    public function index($slug) {
        $HealthTips = HealthTips::where('slug',$slug)->first();
        $categories = HealthTipsCategory::all();
        $recent = HealthTips::latest()->take(4)->get();
        return view('frontend.pages.health_tips_details',compact('HealthTips','categories','recent'));
    }
    public function allTips() {
//        dd('asf');
        $Tips = HealthTips::latest()->paginate(4);
        $category = HealthTipsCategory::all();
        $recentTips = HealthTips::latest()->take(4)->get();
        return view('frontend.pages.health_tips_list',compact('Tips','category','recentTips'));
    }
    public function postByCategory($slug) {
        $category = HealthTipsCategory::where('slug',$slug)->first();
        $posts = $category->posts()->paginate(8);
        $categories = HealthTipsCategory::all();
        $recentPosts = HealthTips::latest()->take(4)->get();
        return view('frontend.pages.health_tips_categories',compact('posts','categories','recentPosts'));
    }
}
