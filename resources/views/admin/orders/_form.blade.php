<div class="container">
    <div class="col-md-8">

        <div class="mb-3">
            <label for="status">Status: </label>
            <div>
                @foreach($status_options as $key => $value)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" id="status_{{$key}}" value="{{$key}}" @checked($key==old('status',$order->status) )>
                    <label class="form-check-label" for="status_{{$key}}">{{$value}}</label>

                </div>
                @endforeach
            </div>
        </div>


        <button type="submit" class="btn btn-primary">{{ $btn_submit ?? 'Save' }}</button>
    </div>
</div>