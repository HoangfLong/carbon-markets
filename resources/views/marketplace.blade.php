@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<body>
    <!-- ##### Header Area Start ##### -->
    @include('layouts.header')
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="build/assets/img/core-img/bag.svg" alt=""> <span>3</span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="build/assets/img/product-img/product-1.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>

                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="build/assets/img/product-img/product-2.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>

                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="build/assets/img/product-img/product-3.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>$274.00</span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>discount:</span> <span>-15%</span></li>
                    <li><span>total:</span> <span>$232.00</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout.html" class="btn essence-btn">check out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('build/assets/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Projects</h2>
                    </div>
                </div>
                <form action="{{ route('market') }}" method="GET">
                    <div class="search-bar">
                        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Popular Filters</h6>
                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#clothing">
                                        <a href="#">Project kind</a>
                                        <ul class="sub-menu collapse show" id="clothing">
                                            <li><a href="#">Biodiversity</a></li>
                                            <li><a href="#">Carbon forward</a></li>
                                            <li><a href="#">Carbon offsetting</a></li>
                                            <li><a href="#">Contribution</a></li>
                                            <li><a href="#">Energy Attributes Certificate (EACs)</a></li>
                                        </ul>
                                    </li>
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#shoes" class="collapsed">
                                        <a href="#">Registry</a>
                                        <ul class="sub-menu collapse" id="shoes">
                                            <li><a href="#">CDM Registry</a></li>
                                            <li><a href="#">Verra Registry</a></li>
                                            <li><a href="#">Isometric Registry</a></li>
                                            <li><a href="#">GSF Registry</a></li>
                                            <li><a href="#">EcoRegistry</a></li>
                                            <li><a href="#">Puro Registry</a></li>
                                            <li><a href="#">ICR (International Carbon Registry)</a></li>
                                            <li><a href="#">MITECO</a></li>
                                            <li><a href="#">The Reserve</a></li>
                                            <li><a href="#">City Forest Registry</a></li>
                                            <li><a href="#">Evident</a></li>
                                        </ul>
                                    </li>
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#accessories" class="collapsed">
                                        <a href="#">Standard type</a>
                                        <ul class="sub-menu collapse" id="accessories">
                                            <li><a href="#">CDM Standard</a></li>
                                            <li><a href="#">VCS</a></li>
                                            <li><a href="#">Isometric Standard</a></li>
                                            <li><a href="#">Gold Standard</a></li>
                                            <li><a href="#">CerCarbono</a></li>
                                            <li><a href="#">Puro Standard</a></li>
                                            <li><a href="#">ICR Standard</a></li>
                                            <li><a href="#">MITECO</a></li>
                                            <li><a href="#">CAR Standard</a></li>
                                            <li><a href="#">City Forest Credits</a></li>
                                            <li><a href="#">ACR Standard</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            {{-- <h6 class="widget-title mb-30">Filter by</h6> --}}
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                </div>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        {{-- <div class="widget color mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li>
                                </ul>
                            </div>
                        </div> --}}

                        <!-- ##### Single Widget ##### -->
                        {{-- <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">Asos</a></li>
                                    <li><a href="#">Mango</a></li>
                                    <li><a href="#">River Island</a></li>
                                    <li><a href="#">Topshop</a></li>
                                    <li><a href="#">Zara</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        @if ($search)
                                            <p><span>{{ $productCount }}</span> projects found"{{ $search }}"</p>
                                        @else
                                            <p><span>{{ $productCount }}</span> projects found</p>
                                        @endif
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="{{ route('market') }}" method="get">
                                            <select name="sort_by" id="sortByselect" onchange="this.form.submit()">
                                                <option value="highest_rated" {{ request('sort_by') == 'highest_rated' ? 'selected' : '' }}>Highest Rated</option>
                                                <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest</option>
                                                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price: $$ - $</option>
                                                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price: $ - $$</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- Single Product -->
                            {{-- <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="build/assets/img/product-img/product-1.jpg" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="build/assets/img/product-img/product-2.jpg" alt="">

                                        <!-- Product Badge -->
                                        <div class="product-badge offer-badge">
                                            <span>-30%</span>
                                        </div>
                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price"><span class="old-price">$75.00</span> $55.00</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  --}}
                         <!-- search bar -->
                        @if($search) 
                            <h4>Search results for: "{{ $search }}"</h4>
                            @if($carbonProjects->isEmpty())
                                <p>No matching projects found.</p>
                            @endif
                        @endif 
                        @foreach ($carbonProjects as $project)
                            @if($project->status === 'Certified' && $project->credits->isNotEmpty()) <!-- Check if status is Certified -->
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <div class="product-img" style="position: relative; overflow: hidden;">
                                            @if($project->images->isNotEmpty())
                                                <img src="{{ asset('storage/'.$project->images->first()->image_path) }}" alt="Project Image" class="img-fluid">
                                                <!-- Hover Thumb -->
                                                <img class="hover-img" src="{{ asset('storage/'.$project->images->first()->image_path) }}" alt="Project Image" class="img-fluid">
                                            @endif
                                            <!-- Product Badge -->
                                            {{-- <div class="product-badge offer-badge">
                                                <span>-30%</span>
                                            </div> --}}
                                            <!-- Favourite -->
                                            <div class="product-favourite">
                                                <a href="#" class="favme fa fa-heart"></a>
                                            </div>
                                        </div>
                        
                                        <!-- Product Description -->
                                        <div class="product-description">
                                            <span>Tag ở đây</span>
                                            <a href="{{ route('payment.show', $project->id) }}">
                                                <h6>{{ $project->name }}</h6>
                                            </a>
                                            <p class="product-price">{{ $project->credits->first()->price_per_ton }} $</p>
                        
                                            <!-- Hover Content -->
                                            <div class="hover-content">
                                                <!-- Add to Cart -->
                                                <div class="add-to-cart-btn">
                                                    <form class="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="credit_id" value="{{ $project->credits->first()->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" class="btn essence-btn">Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endif
                        @endforeach
                        
      
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lắng nghe sự kiện submit của tất cả các form có class "addToCartForm"
        $('.addToCartForm').submit(function(event) {
            event.preventDefault(); // Ngừng việc submit form mặc định

            // Lấy dữ liệu từ form
            var formData = $(this).serialize();

            // Gửi AJAX request
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Cập nhật số lượng giỏ hàng trong header sau khi thành công
                    $('#cart-count').text(response.cartItemsCount); // Lấy số lượng từ response trả về
                    alert(response.message); // Thông báo thành công (hoặc có thể tùy chỉnh)
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error);
                }
            });
        });
    });
</script>
