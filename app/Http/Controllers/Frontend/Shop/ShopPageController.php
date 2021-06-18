<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\ShopPage;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopPageController extends Controller
{
    public function privacy_and_policy(){
        $privacy_and_policy = ShopPage::where('slug','privacy-and-policy')->first();
        return view('frontend-shop.pages.privacy_and_policy',compact('privacy_and_policy'));
    }

    public function terms_and_conditions(){
        $terms_and_conditions = ShopPage::where('slug','terms-and-conditions')->first();
        return view('frontend-shop.pages.terms_and_conditions',compact('terms_and_conditions'));
    }

    public function faq(){
        $faq = ShopPage::where('slug','faq')->first();
        return view('frontend-shop.pages.faq',compact('faq'));
    }

    public function about_us(){
        $about_us = ShopPage::where('slug','about-us')->first();
        return view('frontend-shop.pages.about_us',compact('about_us'));
    }
    public function contact_us(){
        return view('frontend-shop.pages.contact_us');
    }
}
