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
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->deleted_at }}</td>

            
            
            <td>
                <form action="{{ route('categories.restore', $category->id) }}" method="post">
                    @csrf
                    @method("put")
                    <button type="submit" class="btn btn -sm btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                </form>
            </td>

            <td>
                <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
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