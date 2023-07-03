@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">Edit Password User: </h2>
<!-- enctype="multipart/form-data" -->
<form action="<?= route('users.update-password', $user->id) ?>" method="post">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="password">New Password: </label>
        <div>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="" placeholder="Enter Password User">
            @error('password')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="password_confirmation">Confirm Password: </label>
        <div>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password:">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>

</form>
@endsection