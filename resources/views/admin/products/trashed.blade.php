@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3"> Tashed Products </h2>

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Deleted_at</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->deleted_at }}</td>

            
            
            <td>
                <form action="{{ route('products.restore', $product->id) }}" method="post">
                    @csrf
                    @method("put")
                    <button type="submit" class="btn btn -sm btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                </form>
            </td>

            <td>
                <form action="{{ route('products.force-delete', $product->id) }}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn -sm btn-danger"><i class="fas fa-trash"></i> Force Delete</button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection