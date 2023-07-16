<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GridProducts extends Component
{
    /**
     * Create a new component instance.
     */
    public $products;
    public $title; 

    public function __construct( $product = new Product() , $title = '' , $count = 14  )
    {
        $this->products = $product->active()
        ->take($count)
        ->paginate(6);
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::all();
        return view('components.grid-products',[
            'categories' => $categories,
        ]);
    }
}
