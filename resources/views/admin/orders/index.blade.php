@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
    <h2 class="mb-4 fs-3"> {{ $intro }} </h2>
    <div class="ml-auto">
    </div>
</header>


@if(session()->has('tm'))
<div class="alert alert-success">
    {{ session('tm') }}
</div>
@endif


<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer_first_name }}</td>
            <td>{{ $order->customer_last_name }}</td>
            <td>{{ $order->customer_email }}</td>
            <td>{{ $order->customer_phone }}</td>
            <td>{{ $order->customer_address }}</td>
            <td>{{ $order->status }}</td>

            <td><a href="{{ route('orders.edit', $order->id) }}" class="btn btn -sm btn-outline-dark"><i class="fas fa-edit"></i> Edit</a> </td>
            <td>
                <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn -sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $orders->links() }}
</div>

@endsection