<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index(){
        $reviews = Review::all();
        return('admin.reviews.index');
    }


    public function store(Request $request , $slug){

        $request->validate([
            'user_review' => 'string|nullable|max:1000',
            'review_rating' => 'string|nullable',
        ]);

        $check = Product::where('slug', '=' , $slug)->firstOrFail();
        if($check){
            $review = Review::create([
                'user_id' => Auth::id(),
                'product_id' => $check->id,
                'user_review' => $request->user_review,
                'review_rating' => $request->review_rating,
            ]);
        return redirect()->route('shop.products.show' , $check->slug);
        }
        else{
            return redirect()->back();
        }
    }


    public function edit(Review $review){
        return view('admin.reviews.update_review',[
            'review'=>  $review
        ]);
    }

    public function update(Request $request , Review $review ){

    }

    public function destroy(Review $review){

        $review->delete();

        return redirect()->route('review.index'); 
    }
}
