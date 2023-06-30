<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){

    }

    public function show($slug){
        $product = Product::active()->where('slug', '=' , $slug)->firstOrFail();
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();
        return view('shop.products.show',[
            'product' => $product ,
            'gallery' => $gallery ,
        ]);
    }
}
