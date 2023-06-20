@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3"> {{ $title }} </h2>

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<a href="<?= route('products.create') ?>" class="btn btn-sm btn-primary">+ Create Product</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Status</th>
            <th>Slug</th>
            <th>images</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->slug }}</td>
            <td>
                @if($product->image)
                <a href="{{ Storage::disk('public')->url($product->image) }}"></a>
                <img src="{{ asset('storage/'. $product->image) }}" alt="" width="60"></td>
                @else
                <img src="https://placehold.co/60x60" alt="">
                @endif
            <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn -sm btn-outline-dark"><i class="fas fa-edit"></i> Edit</a> </td>
            <td>
                <form   action ="{{ route('products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn -sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection