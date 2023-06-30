<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShopLayout extends Component
{
    public $title;
    public $showBreadCrumb;
    

    public function __construct($title = 'Title' , $showBreadCrumb = true )
    {
        $this->title = $title;
        $this->showBreadCrumb = $showBreadCrumb;
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
        return view('layouts.shop', [
            'products' => $products,
        ]);
    }
}