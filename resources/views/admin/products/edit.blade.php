@extends('layouts.admin')

@section('content')
        <h2 class="mb-4 fs-3">Edit Product</h2>
        <form action="<?= route('products.update', $product->id) ?>" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('admin.products._form',['btn_submit' => 'Update'])

        </form>
@endsection
