<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1', 'max:99'],
        ]);

        $cookie_id = $request->cookie('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30);
        }

        $item = Cart::where('cooke_id', '=', $cookie_id)
            ->where('product_id', '=', $request->input('product_id'))
            ->first();

        if ($item) {
            $item->increment('quantity', $request->input('quantity', 1));
        } else {
            Cart::create([
                'cooke_id' => $cookie_id,
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity',1),
            ]);
        }
        return redirect()->back()->with('success','Product added to cart');
    }


    public function destroy($id)
    {
    }
}
