<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlistAdd($id)
    {
        if (Auth::user())
        {
            $check = Wishlist::where('product_id', $id)->where('user_id', Auth::id())->first();

            if(empty($check)){
                $wishList = new Wishlist();
                $wishList->product_id = $id;
                $wishList->user_id = Auth::id();
                $wishList->save();
                Toastr::success('This product added in your wishlist','success');
                return redirect()->back();

            }else{
                Toastr::warning('This product already added in your wishlist','Success');
                return back();
            }
        }else{
            Toastr::warning('Login first to add wishlist');
            return back();
        }
    }
    public function wishlist(){
        $wishlists = Wishlist::where('user_id', Auth::id())->latest()->get();
        return view('backend.user.product_wishlist', compact('wishlists'));
    }
    public function wishlistRemove($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        Toastr::success('This product remove from wishlist');
        return redirect()->back();
    }
}
