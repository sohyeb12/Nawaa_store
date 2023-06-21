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
        <div class="mb-3">
            <label for="name">Name: </label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$product->name) }}" placeholder="Enter Name Product">
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="slug">URL Slug: </label>
            <div>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug',$product->slug) }}" placeholder="URL Slug">
                @error('slug')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="description">Description: </label>
            <div>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{ old('description',$product->description) }}</textarea>
                @error('description')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="short_description">Short Description</label>
            <div>
                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" placeholder="Short_description">{{ old('short_description',$product->short_description) }}</textarea>
                @error('short_description')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="price">Price: </label>
            <div>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price',$product->price) }}" placeholder="Enter Price">
                @error('price')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="compare_price">Compare Price: </label>
            <div>
                <input type="number" class="form-control @error('compare_price') is-invalid @enderror" id="compare_price" value="{{ old('compare_price',$product->compare_price) }}" name="compare_price" placeholder="Enter Compare Price">
                @error('compare_price')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="gallery">Gallery Image : </label>

            <div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" multiple width="100" id="gallery" name="gallery[]" placeholder="Product Image">
            </div>
            @if ($gallery)
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

        <div class="mb-3">
            <label for="category_id">Category ID: </label>
            <div>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option></option>
                    @foreach($category as $value)
                    <option @selected($value->id == $product->category_id) value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

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