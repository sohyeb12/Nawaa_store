@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
    <h2 class="mb-4 fs-3"> {{ $intro }} </h2>
    <div class="ml-auto">
        <a href="<?= route('categories.create') ?>" class="btn btn-sm btn-primary">+ Create Category</a>
        <a href="<?= route('categories.trashed') ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
            View Trashed</a>
    </div>
</header>


@if(session()->has('done'))
<div class="alert alert-success">
    {{ session('done') }}
</div>
@endif


<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $cateogry)
        <tr>
            <td>{{ $cateogry->id }}</td>
            <td>{{ $cateogry->name }}</td>
            <td>{{ $cateogry->created_at }}</td>


            <td><a href="{{ route('categories.edit', $cateogry->id) }}" class="btn btn -sm btn-outline-dark"><i class="fas fa-edit"></i> Edit</a> </td>
            <td>
                <form action="{{ route('categories.destroy', $cateogry->id) }}" method="post">
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
    {{ $categories->links() }}
</div>

@endsection