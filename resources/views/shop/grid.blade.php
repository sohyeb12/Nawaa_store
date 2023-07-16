<x-shop-layout title="Shop Grid" :show-bread-crumb="true" breadCrumbValue="Shop > Shop Grid">

    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <form action="{{ route('grid.products') }}" method="get">
                        <div class="product-sidebar">
                            <!-- Start Single Widget -->
                            <div class="single-widget search">
                                <h3>Search Product</h3>

                                <input type="text" name="search" placeholder="Search Here...">
                                <!-- <button type="submit"><i class="lni lni-search-alt"></i></button> -->

                            </div>
                            <!-- End Single Widget -->

                            <!-- Start Single Widget -->
                            <div class="single-widget range">
                                <h3>Price Range</h3>
                                <input type="number" name="price_min" class="form-control mb-2 mr-2" placeholder="Minimum Price">
                                <input type="number" name="price_max" class="form-control mb-2 mr-2" placeholder="Maximum Price">
                            </div>
                            <!-- End Single Widget -->

                            <!-- Start Single Widget -->
                            <div class="single-widget range">
                                <h3>Filter By Category</h3>
                                <select id="category_id" name="category_id" class="form-control mb-2 mr-2">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $value)
                                    <option value="{{ $value->id }}" @selected(request('category_id')==$value->id )>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- End Single Widget -->
                            <div style="margin-left: 60px;">
                                <button type="submit" class="btn btn-sm btn-primary" style="width: 120px;">Filter</button>
                            </div>
                        </div>
                        <!-- End Product Sidebar -->
                    </form>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">


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
</x-shop-layout>