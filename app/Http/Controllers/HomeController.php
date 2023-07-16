<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $products =  Product::withoutGlobalScope('owner')
        // ->active()
        // ->latest()
        // ->take(8)
        // ->get();

        $categories = Category::all();
        $products = Product::active()->limit(3)->get();
        $products_latest = Product::latest('created_at')->limit(3)->get();
        $products_rated = Product::where('category_id','=',2)->limit(3)->get();
        return view('shop.home',[
            "categories" => $categories,
            'products' => $products,
            'products_latest' => $products_latest,
            'products_rated' => $products_rated,
        ]);
    }

    public function show_grid(Request $request)
    {

        $products = Product::when($request->search ?? false, function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('products.name', 'LIKE', "%{$value}%")
                    ->orWhere('products.description', 'LIKE', "%{$value}%");
            });
        })
            ->when($request->status ?? false, function ($query, $value) {
                $query->where('products.status', '=', $value);
            })
            ->when($request->category_id ?? false, function ($query, $value) {
                $query->where('products.category_id', '=', $value);
            })
            ->when($request->price_min ?? false, function ($query, $value) {
                $query->where('products.price', '>=', $value);
            })
            ->when($request->price_max ?? false, function ($query, $value) {
                $query->where('products.compare_price', '<=', $value);
            })->paginate(6);

        $categories = Category::all();
        return view('shop.grid', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
