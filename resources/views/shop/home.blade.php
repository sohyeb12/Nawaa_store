<x-shop-layout title="home" :show-bread-crumb="true" bread-crumb-value=" ">
    <div>
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>
    <script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

        const timer = () => {
            const now = new Date().getTime();
            let diff = finaleDate - now;
            if (diff < 0) {
                document.querySelector('.alert').style.display = 'block';
                document.querySelector('.container').style.display = 'none';
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
            let seconds = Math.floor(diff % (1000 * 60) / 1000);

            days <= 99 ? days = `0${days}` : days;
            days <= 9 ? days = `00${days}` : days;
            hours <= 9 ? hours = `0${hours}` : hours;
            minutes <= 9 ? minutes = `0${minutes}` : minutes;
            seconds <= 9 ? seconds = `0${seconds}` : seconds;

            document.querySelector('#days').textContent = days;
            document.querySelector('#hours').textContent = hours;
            document.querySelector('#minutes').textContent = minutes;
            document.querySelector('#seconds').textContent = seconds;

        }
        timer();
        setInterval(timer, 1000);
    </script>
    <script type="text/javascript">
        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });
    </script>
        <!-- Start Hero Area -->
        <section class="hero-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 custom-padding-right">
                        <div class="slider-head">
                            <!-- Start Hero Slider -->
                            <div class="hero-slider">
                                <!-- Start Single Slider -->
                                <div class="single-slider" style="background-image: url(https://via.placeholder.com/800x500);">
                                    <div class="content">
                                        <h2><span>No restocking fee ($35 savings)</span>
                                            M75 Sport Watch
                                        </h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut
                                            labore dolore magna aliqua.</p>
                                        <h3><span>Now Only</span> $320.99</h3>
                                        <div class="button">
                                            <a href="product-grids.html" class="btn">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slider -->
                                <!-- Start Single Slider -->
                                <div class="single-slider" style="background-image: url(https://via.placeholder.com/800x500);">
                                    <div class="content">
                                        <h2><span>Big Sale Offer</span>
                                            Get the Best Deal on CCTV Camera
                                        </h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut
                                            labore dolore magna aliqua.</p>
                                        <h3><span>Combo Only:</span> $590.00</h3>
                                        <div class="button">
                                            <a href="product-grids.html" class="btn">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slider -->
                            </div>
                            <!-- End Hero Slider -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                                <!-- Start Small Banner -->
                                <div class="hero-small-banner" style="background-image: url('https://via.placeholder.com/370x250');">
                                    <div class="content">
                                        <h2>
                                            <span>New line required</span>
                                            iPhone 12 Pro Max
                                        </h2>
                                        <h3>$259.99</h3>
                                    </div>
                                </div>
                                <!-- End Small Banner -->
                            </div>
                            <div class="col-lg-12 col-md-6 col-12">
                                <!-- Start Small Banner -->
                                <div class="hero-small-banner style2">
                                    <div class="content">
                                        <h2>Weekly Sale!</h2>
                                        <p>Saving up to 50% off all online store items this week.</p>
                                        <div class="button">
                                            <a class="btn" href="product-grids.html">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Small Banner -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero Area -->

        <!-- Start Featured Categories Area -->
        <section class="featured-categories section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Featured Categories</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Single Category -->
                            <div class="single-category">
                                <h3 class="heading">{{ $category->name }}</h3>
                                <ul>
                                    @foreach($category->products()->limit(4)->get() as $product)
                                    <li><a href="{{ route('shop.products.show' , $product->slug) }}">{{ $product->name }}</a></li>
                                    @endforeach
                                </ul>
                                <div class="images">
                                    <img src="{{ $category->image_url }}" alt="#" width="180" height="180">
                                </div>
                            </div>
                            <!-- End Single Category -->
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Features Area -->

        <!-- Start Trending Product Area -->
        <x-trending-products title="Trending Products!!" count="8" />
        <!-- End Trending Product Area -->


        <!-- Start Special Offer -->
        <x-special-offer count="6" />
        <!-- End Special Offer -->

        <!-- Start Home Product List -->
        <section class="home-product-list section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                        <h4 class="list-title">Best Sellers</h4>
                        @foreach($products as $product)
                        <!-- Start Single List -->
                            <div class="single-list">
                                <div class="list-image">
                                    <a href="{{ route('shop.products.show' , $product->slug) }}"><img src="{{ $product->image_url }}" alt="#"></a>
                                </div>
                                <div class="list-info">
                                    <h3>
                                        <a href="{{ route('shop.products.show' , $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <span>{{ $product->price_formatted }}</span>
                                </div>
                            </div>
                        <!-- End Single List -->
                        @endforeach
                        <!-- End Single List -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                        <h4 class="list-title">New Arrivals</h4>
                        @foreach($products_latest as $product)
                        <!-- Start Single List -->
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('shop.products.show' , $product->slug) }}"><img src="{{ $product->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('shop.products.show' , $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <span>{{ $product->price_formatted }}</span>
                            </div>
                        </div>
                        <!-- End Single List -->
                        @endforeach
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <h4 class="list-title">Top Rated</h4>
                        @foreach($products_rated as $product)
                        <!-- Start Single List -->
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('shop.products.show' , $product->slug) }}"><img src="{{ $product->image_url }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a href="{{ route('shop.products.show' , $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <span>{{ $product->price_formatted }}</span>
                            </div>
                        </div>
                        <!-- End Single List -->
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        <!-- End Home Product List -->


        <!-- Start Shipping Info -->
        <section class="shipping-info">
            <div class="container">
                <ul>
                    <!-- Free Shipping -->
                    <li>
                        <div class="media-icon">
                            <i class="lni lni-delivery"></i>
                        </div>
                        <div class="media-body">
                            <h5>Free Shipping</h5>
                            <span>On order over $99</span>
                        </div>
                    </li>
                    <!-- Money Return -->
                    <li>
                        <div class="media-icon">
                            <i class="lni lni-support"></i>
                        </div>
                        <div class="media-body">
                            <h5>24/7 Support.</h5>
                            <span>Live Chat Or Call.</span>
                        </div>
                    </li>
                    <!-- Support 24/7 -->
                    <li>
                        <div class="media-icon">
                            <i class="lni lni-credit-cards"></i>
                        </div>
                        <div class="media-body">
                            <h5>Online Payment.</h5>
                            <span>Secure Payment Services.</span>
                        </div>
                    </li>
                    <!-- Safe Payment -->
                    <li>
                        <div class="media-icon">
                            <i class="lni lni-reload"></i>
                        </div>
                        <div class="media-body">
                            <h5>Easy Return.</h5>
                            <span>Hassle Free Shopping.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Shipping Info -->
    </div>

    
</x-shop-layout>