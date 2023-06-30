<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TrendingProducts extends Component
{
    public $products;
    public $title;

    public function __construct($title = 'Product Trending', $count = 4)
    {
        $this->title = $title;
        $this->products =  Product::withoutGlobalScope('owner')
        ->active()
        ->latest('updated_at')
        ->take($count)
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trending-products');
    }
}
