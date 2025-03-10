@extends('layouts.app')

@section('content')
 <div class="top_catagory_area section-padding-80 clearfix">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(build/assets/img/bg-img/bg-2.jpg);">
                    <div class="catagory-content">
                        <a href="#">Carbon offsetting</a>
                    </div>
                </div>
            </div>
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(build/assets/img/bg-img/bg-3.jpg);">
                    <div class="catagory-content">
                        <a href="#">Removals</a>
                    </div>
                </div>
            </div>
            <!-- Single Catagory -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(build/assets/img/bg-img/bg-4.jpg);">
                    <div class="catagory-content">
                        <a href="#">Biodiversity</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Top Catagory Area End ##### -->

<!-- ##### CTA Area Start ##### -->
{{-- <div class="cta-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-content bg-img background-overlay" style="background-image: url(build/assets/img/bg-img/bg-5.jpg);">
                    <div class="h-100 d-flex align-items-center justify-content-end">
                        <div class="cta--text">
                            <h6>-60%</h6>
                            <h2>Global Sale</h2>
                            <a href="#" class="btn essence-btn">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ##### CTA Area End ##### -->
<div class="container">
    @yield('content') <!-- Đây là nơi phần thân sẽ được thay đổi -->
</div>
<!-- ##### New Arrivals Area Start ##### -->
{{-- <section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Popular Project</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    @foreach($carbonProjects as $project)
                        @if($project->status === 'Certified' && $project->credits->isNotEmpty()) <!-- Check if status is Certified -->
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                @if($project->images->isNotEmpty())
                                    <img src="{{ asset('storage/'.$project->images->first()->image_path) }}" alt="Project Image" class="img-fluid">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="{{ asset('storage/'.$project->images->first()->image_path) }}" alt="Project Image" class="img-fluid">
                                @endif
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
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach --}}
                    {{-- <!-- Single Product -->
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="build/assets/img/product-img/product-2.jpg" alt="">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="build/assets/img/product-img/product-3.jpg" alt="">
                            <!-- Favourite -->
                            <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <span>topshop</span>
                            <a href="single-product-details.html">
                                <h6>Poplin Displaced Wrap Dress</h6>
                            </a>
                            <p class="product-price">$80.00</p>

                            <!-- Hover Content -->
                            <div class="hover-content">
                                <!-- Add to Cart -->
                                <div class="add-to-cart-btn">
                                    <a href="#" class="btn essence-btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Product -->
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="build/assets/img/product-img/product-3.jpg" alt="">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="build/assets/img/product-img/product-4.jpg" alt="">

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
                            <span>mango</span>
                            <a href="single-product-details.html">
                                <h6>PETITE Crepe Wrap Mini Dress</h6>
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

                    <!-- Single Product -->
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="build/assets/img/product-img/product-4.jpg" alt="">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="build/assets/img/product-img/product-5.jpg" alt="">

                            <!-- Product Badge -->
                            <div class="product-badge new-badge">
                                <span>New</span>
                            </div>

                            <!-- Favourite -->
                            <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <span>mango</span>
                            <a href="single-product-details.html">
                                <h6>PETITE Belted Jumper Dress</h6>
                            </a>
                            <p class="product-price">$80.00</p>

                            <!-- Hover Content -->
                            <div class="hover-content">
                                <!-- Add to Cart -->
                                <div class="add-to-cart-btn">
                                    <a href="#" class="btn essence-btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### New Arrivals Area End ##### -->

<!-- ##### Brands Area Start ##### -->
<div class="brands-area d-flex align-items-center justify-content-between">
    <!-- Brand Logo -->
    <div class="single-brands-logo">
        <img src="build/assets/img/core-img/brand1.png" alt="">
    </div>
    <!-- Brand Logo -->
    <div class="single-brands-logo">
        <img src="build/assets/img/core-img/brand2.png" alt="">
    </div>
    <!-- Brand Logo -->
    <div class="single-brands-logo">
        <img src="build/assets/img/core-img/brand3.png" alt="">
    </div>
    <!-- Brand Logo -->
    <div class="single-brands-logo">
        <img src="build/assets/img/core-img/brand4.png" alt="">
    </div>
    <!-- Brand Logo -->
    <div class="single-brands-logo">
        <img src="build/assets/img/core-img/brand5.png" alt="">
    </div>
    <!-- Brand Logo -->
    <div class="single-brands-logo">
        <img src="build/assets/img/core-img/brand6.png" alt="">
    </div>
</div>
@endsection