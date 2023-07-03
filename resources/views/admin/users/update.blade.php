@if(session()->has('error'))
<div class="alert alert-success">
    {{ session('error') }}
</div>
@endif


<div class="container">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="name">Name User: </label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$user->name) }}" placeholder="Enter Name User">
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="email">Email User: </label>
            <div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$user->email) }}" placeholder="Enter Email User">
                @error('email')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="status">Status: </label>
            <div>
                @foreach($status_options as $key => $value)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" id="status_{{$key}}" value="{{$key}}" @checked($key==old('status',$user->status) )>
                    <label class="form-check-label" for="status_{{$key}}">{{$value}}</label>

                </div>
                @endforeach
            </div>
        </div>


        <div class="mb-3">
            <label for="type">User Type: </label>
            <div>
                @foreach($user_types as $key => $value)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="type" id="type_{{$key}}" value="{{$key}}" @checked($key==old('type',$user->type) )>
                    <label class="form-check-label" for="type_{{$key}}">{{$value}}</label>

                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ $btn_submit ?? 'Save' }}</button>
    </div>
</div>