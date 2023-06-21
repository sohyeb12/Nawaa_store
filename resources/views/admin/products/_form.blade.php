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
<div>
    <div class="col-md-8">
        <x-form.input type="text" label="Product Name" id="name" value="{{$product->name}}" name="name" />

        <x-form.input type="text" label="URL Slug" id="slug" value="{{$product->slug}}" name="slug" />


        <x-form.textarea id="description" name="description" label="Description" value="{{ $product->description }}" />


        <x-form.textarea id="short_description" name="short_description" label="Short Description" value="{{ $product->short_description }}" />


        <x-form.input type="number" label="Product Price" id="price" value="{{$product->price}}" name="price" />

        <x-form.input type="number" label="Compare Price" id="compare_price" value="{{$product->compare_price}}" name="compare_price" />


        <div class="mb-3">
            <label for="gallery">Gallery Image : </label>

            <div>
                <input type="file" class="form-control" width="100" id="gallery" name="gallery[]" multiple placeholder="Product Image">
            </div>
            @if ($gallery ?? false)
            <div class="row">
                @foreach($gallery as $image)
                <div class="col-md-3">
                    <img src="{{ $image->url }}" class="img-fluid" alt="">
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

    <div class="col-md-4">

        <x-form.select id="category_id" name="category_id" label="Category ID" value="{{ $product->category_id }} " :options="$category->pluck('name','id')" />

        <div class="mb-3">
            <label for="status">Status: </label>
            <div>
                @foreach($status_options as $key => $value)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" id="status_{{$key}}" value="{{$key}}" @checked($key==old('status',$product->status) )>
                    <label class="form-check-label" for="status_{{$key}}">{{$value}}</label>

                </div>
                @endforeach
            </div>
        </div>


        <div class="mb-3">
            <label for="image">Product Image : </label>

            <img src="{{ $product->image_url }}" alt="" width="100">

            <div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" width="100" id="image" name="image" placeholder="Product Image">
                @error('image')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">{{ $btn_submit ?? 'Save' }}</button>
</div>