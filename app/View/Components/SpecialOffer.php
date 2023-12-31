<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpecialOffer extends Component
{
    /**
     * Create a new component instance.
     */

    public $products;
    public $title;

    public function __construct($title = 'Special Offer', $count = 4)
    {
        $this->title = $title;
        $this->products =  Product::withoutGlobalScope('owner')
        ->active()
        ->with('category')
        ->latest('updated_at')
        ->take($count)
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.special-offer');
    }
}
