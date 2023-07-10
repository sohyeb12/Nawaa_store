@extends('layouts.admin')

@section('content')
        <h2 class="mb-4 fs-3">{{ 'New User' }}</h2>
        <!-- enctype="multipart/form-data" -->
        <form action="<?= route('users.store') ?>" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.users._form',['btn_submit' => 'Create'])

        </form>
@endsection
