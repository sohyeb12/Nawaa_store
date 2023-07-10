@extends('layouts.admin')

@section('content')
        <h2 class="mb-4 fs-3">Edit Order: </h2>
        <!-- enctype="multipart/form-data" -->
        <form action="<?= route('orders.update', $order->id) ?>" method="post">
            @csrf
            @method('put')
            @include('admin.orders._form',['btn_submit' => 'Update'])

        </form>
@endsection