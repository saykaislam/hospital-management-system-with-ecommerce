<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogList(){
        $blogs = Blog::latest()->get();
        $recentBlogs = Blog::latest()->take(4)->get();
        return view('frontend-shop.pages.blog.blog_list',compact('blogs','recentBlogs'));
    }
    public function blogDetails($slug){
        $blog = Blog::where('slug',$slug)->first();
        $recentBlogs = Blog::latest()->take(4)->get();
        return view('frontend-shop.pages.blog.blog_details',compact('blog','recentBlogs'));
    }
}
