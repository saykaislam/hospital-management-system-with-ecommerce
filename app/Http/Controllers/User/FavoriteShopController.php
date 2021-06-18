<?php

namespace App\Http\Controllers\User;

use App\FavoriteShop;
use App\Http\Controllers\Controller;
use App\Shop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteShopController extends Controller
{
    public function addFavoriteShop($id){
        $shop = Shop::find($id);
        if (Auth::user())
        {
            $check = FavoriteShop::where('user_id', Auth::id())->where('shop_id', $shop->id)->first();
            if (empty($check)){
                $favoriteShop = new FavoriteShop();
                $favoriteShop->user_id = Auth::id();
                $favoriteShop->shop_id= $shop->id;
                $favoriteShop->save();
                Toastr::success("Followed Successfully","Success");
                return redirect()->back();
            }else{
                Toastr::error("You are already following this shop","Success");
                return redirect()->back();
            }

        }else{
            Toastr::warning('Login first to Follow');
            return redirect()->back();
        }
    }
    public function removeFavoriteShop($id) {
        $shop = Shop::find($id);
        $favoriteShop = FavoriteShop::where('user_id', Auth::id())->where('shop_id', $shop->id)->first();
        $favoriteShop->delete();
        Toastr::success("Unfollowed Successfully","Success");
        return redirect()->back();
    }
    public function favoriteShopList(){
        $favoriteShops = FavoriteShop::where('user_id',Auth::id())->latest()->get();
        return view('backend.user.favorite_shops',compact('favoriteShops'));
    }
}
