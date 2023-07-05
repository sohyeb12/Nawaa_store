@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
    <h2 class="mb-4 fs-3"> {{ $title }} </h2>
    <div class="ml-auto">
        <a href="<?= route('products.create') ?>" class="btn btn-sm btn-primary">+ Create Product</a>
        <a href="<?= route('products.trashed') ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
            View Trashed</a>
    </div>
</header>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ URL::current() }}" method="get" class="form-inline">
    <input type="text" name="search" class="form-control mb-2 mr-2" placeholder="Search with Name">

    <select name="status" class="form-control mb-2 mr-2">
        <option value="">Status</option>
        @foreach($status_options as $key => $value)
            <option value="{{ $key }}" @selected(request('status') ==  $key )>{{ $value }}</option>
        @endforeach
    </select>

    <select name="category_id" class="form-control mb-2 mr-2">
        <option value="">All Categories</option>
        @foreach($category as $value)
            <option value="{{ $value->id }}" @selected(request('category_id') ==  $value->id )>{{ $value->name }}</option>
        @endforeach
    </select>

    <input type="number" name="price_min" class="form-control mb-2 mr-2" placeholder="Minimum Price">
    <input type="number" name="price_max" class="form-control mb-2 mr-2" placeholder="Maximum Price">

    <button type="submit" class="btn btn-dark">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Category</th>
            <th>Status</th>
            <th>Slug</th>
            <th>Price</th>
            <th>Images</th>
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
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->slug }}</td>
            <td>{{ $product->price_formatted }}</td>
            <td>
                <a href="{{ $product->image_url }}">
                    <img src="{{ $product->image_url }}" alt="" width="60">
                </a>

            </td>
            
            <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn -sm btn-outline-dark"><i class="fas fa-edit"></i> Edit</a> </td>
            <td>
                <form action="{{ route('products.destroy', $product->id) }}" method="post">
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
    {{ $products->links() }}
</div>
@endsection