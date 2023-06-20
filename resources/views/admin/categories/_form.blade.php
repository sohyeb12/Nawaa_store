<!-- @if ($errors->any())
<div class="alert alert-danger">
    You have some errors:
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif -->
<!-- <div class="col-md-8"></div> -->
<div class="container">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="name">Name Category: </label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$category->name) }}" placeholder="Enter Name category">
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <button type="submit" class="btn btn-primary">{{ $btn_submit ?? 'Save' }}</button>
    </div>
</div>