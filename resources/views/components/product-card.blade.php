<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="#" width="350" height="350" />
        <div class="button">
            <a href="{{ route('shop.products.show' , $product->slug) }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('shop.products.show' , $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            
            @for($i=0; $i < round($product->ComputeAverage($product->id),0) ; $i++)
                <li><i class="lni lni-star-filled"></i></li>
                @endfor

                @for($i=0; $i < (5 - round($product->ComputeAverage($product->id),0)) ; $i++)
                    <li><i class="lni lni-star"></i></li>
                    @endfor
                    <li><span>{{ round($product->ComputeAverage($product->id),0) }} Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ $product->price_formatted }}</span>
            @if (isset($product->compare_price))
            <span class="discount-price">{{ $product->compare_price_formatted }}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->