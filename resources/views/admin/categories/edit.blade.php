@extends('layouts.admin')

@section('content')
        <h2 class="mb-4 fs-3">Edit Category: </h2>
        <!-- enctype="multipart/form-data" -->
        <form action="<?= route('categories.update', $category->id) ?>" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('admin.categories._form',['btn_submit' => 'Update'])

        </form>
@endsection
