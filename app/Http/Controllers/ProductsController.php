<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){

    }

    public function show($slug){
        $product = Product::active()->where('slug', '=' , $slug)->firstOrFail();
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();
        $reviews = Review::where('product_id', '=', $product->id)->latest('created_at')->take(4)->get();
        return view('shop.products.show',[
            'product' => $product ,
            'gallery' => $gallery ,
            'reviews' => $reviews,
            'var' => new Review(),
        ]);
    }
}
