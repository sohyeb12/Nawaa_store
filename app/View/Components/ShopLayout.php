<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\Product;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;

class ShopLayout extends Component
{
    public $title;
    public $showBreadCrumb;
    public $breadCrumbValue;

    public function __construct($title = 'Title' , $showBreadCrumb = true ,  $breadCrumbValue = 'title')
    {
        $this->title = $title;
        $this->showBreadCrumb = $showBreadCrumb;
        $this->breadCrumbValue = $breadCrumbValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $products = Product::active()
                    ->latest()
                    ->limit(8)
                    ->get();
        
        $cart = Cart::where('user_id' , '=' , Auth::id())->get();
        // dd($cart);
        $total = $cart->sum(function($item){
            return ($item->product->price ?? 0) * ($item->quantity ?? 0);
        });

        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        
        return view('layouts.shop', [
            'products' => $products,
            'carts' => $cart,
            'totalPriceFormat' => $formatter->formatCurrency($total,'USD'),
        ]);
    }
}
