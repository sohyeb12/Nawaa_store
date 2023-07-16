<section class="product-grids section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <!-- Start Product Sidebar -->
                <div class="product-sidebar">
                    <!-- Start Single Widget -->
                    <div class="single-widget search">
                        <h3>Search Product</h3>
                        <form action="{{ route('grid.products') }}">
                            <input type="text" name="search" placeholder="Search Here...">
                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </form>
                    </div>
                    <!-- End Single Widget -->

                    <!-- Start Single Widget -->
                    <div class="single-widget range">
                        <h3>Price Range</h3>
                        <input type="range" class="form-range" name="range" step="1" min="100" max="1000" onchange="rangePrimary.value=value">
                        <div class="range-inner">
                            <label>$</label>
                            <input type="number" id="rangePrimary" name="price_max" placeholder="100" />
                            <input type="number" id="price_min" name="price_min" placeholder="100" hidden />
                        </div>
                    </div>
                    <!-- End Single Widget -->



                </div>
                <!-- End Product Sidebar -->
            </div>
            <div class="col-lg-9 col-12">
                <div class="product-grids-head">
                    <div class="product-grid-topbar">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-8 col-12">
                                <div class="product-sorting">
                                    <label for="category_id">Sort by:</label>
                                    <select id="category_id" name="category_id" class="form-control mb-2 mr-2">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $value)
                                        <option value="{{ $value->id }}" @selected(request('category_id')==$value->id )>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <h3 class="total-show-product">Showing: <span>1 - 6 items</span></h3>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-4 col-12">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="true"><i class="lni lni-grid-alt"></i></button>
                                        <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false"><i class="lni lni-list"></i></button>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                            <div class="row">


                                @foreach($products as $product)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <x-product-card :product="$product" />
                                </div>
                                @endforeach



                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Pagination class="pagination left" -->
                                    <div class="pagination left">

                                        {{ $products->links() }}

                                        <!--/ End Pagination -->
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>