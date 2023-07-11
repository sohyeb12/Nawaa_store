<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::where('user_id','=',Auth::id())->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_first_name' => 'sometimes|required',
            'customer_last_name' => 'sometimes|required',
            'customer_email' => 'sometimes|required',
            'customer_phone' => 'nullable',
            'customer_address' => 'sometimes|required',
            'customer_city' => 'sometimes|required',
            'customer_postal_code' => 'nullable' ,
            'customer_province' => 'nullable',
            'customer_country_code' => 'sometimes|required|string|size:2',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['payment_status'] = 'pending';
        $validated['currency'] = 'USD';

        $order = Order::create($validated);

        return [
            'message' => 'Order Created Successfully!!',
            'order' => $order,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Order::with('user','products')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::where('id','=',$id)->first();

        $request->validate([
            'status' =>'sometimes|required|in:pending,processing,shipped,completed,cancelled,refunded',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return [
            'message' => 'Order Updated Successfully!!',
        ]; 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::where('id','=',$id)->delete();

        return [
            'message' => 'the Order Deleted Successfully!!', 
        ];

    }
}
