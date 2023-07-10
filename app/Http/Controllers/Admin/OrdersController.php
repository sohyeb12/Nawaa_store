<?php

namespace App\Http\Controllers\Admin;

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
        $orders =  Order::where('user_id','=',Auth::id())->paginate(5);
        return view('admin.orders.index',[
            'intro' => 'Orders List',
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::where('id','=',$id)->first();
        return view('admin.orders.edit',[
            'order' => $order,
            'status_options' => [
                'pending'=> 'Pending' , 
                'processing'=>'Processing' , 
                'shipped' => 'Shipped' , 
                'completed' => 'Completed', 
                'cancelled' => 'Cancelled' , 
                'refunded' => 'Refunded'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::where('id','=',$id)->first();

        $request->validate([
            'status' =>'required|in:pending,processing,shipped,completed,cancelled,refunded',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('orders.index')->with('tm',"Order ({$order->name}) Updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::where('id','=',$id)->delete();

        return redirect()->route('orders.index')->with('tm',"The Order Deleted!!.");
    }
}
