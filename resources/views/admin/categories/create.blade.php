@extends('layouts.admin')

@section('content')
        <h2 class="mb-4 fs-3">{{ 'New Category' }}</h2>
        <!-- enctype="multipart/form-data" -->
        <form action="<?= route('categories.store') ?>" method="post">
            @csrf
            @include('admin.categories._form',['btn_submit' => 'Create'])

        </form>
@endsection
