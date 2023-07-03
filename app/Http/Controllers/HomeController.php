<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // $products =  Product::withoutGlobalScope('owner')
        // ->active()
        // ->latest()
        // ->take(8)
        // ->get();

        return view('shop.home');
    }

    public function show_grid(){
        return view('shop.grid');
    }
}
