<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductReview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $rating = null;
        $reviews = null;
        return view('backend.admin.product_review.index',compact('rating','reviews'));
    }
    public function reviewDetails(Request $request){
        $rating = $request->rating;
        $reviews = ProductReview::where('rating',$rating)->get();
        return view('backend.admin.product_review.index',compact('rating','reviews'));
    }
    public function updateStatus(Request $request){
        $review = ProductReview::findOrFail($request->id);
        $review->status = $request->status;
        if($review->save()){
            return 1;
        }
        return 0;
    }
    public function view($id){
        $review = ProductReview::find(decrypt($id));
        if($review->viewed == 0){
            $review->viewed = 1;
            $review->save();
        }
        return view('backend.admin.product_review.show',compact('review'));
    }
    public function reviewUpdate(Request $request, $id) {
        $review = ProductReview::find($id);
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Product review Updated Successfully');
        return redirect()->back();
    }

}
