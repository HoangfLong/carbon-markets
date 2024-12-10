<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{{ route('home') }}"><img src="build/assets/img/core-img/logo.png" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="#">Start here</a>
                            <div class="dropdown">
                                <ul class="single-mega cn-col-4">
                                    <li><a href="shop.html">Companies</a></li>
                                    <li><a href="shop.html">Individuals</a></li>
                                    <li><a href="shop.html">Calculators</a></li>
                                    <li><a href="shop.html">About us</a></li>
                                    <li><a href="shop.html">Contact</a></li>
                                </ul>
                                <!-- <ul class="single-mega cn-col-4">
                                    <li class="title">Men's Collection</li>
                                    <li><a href="shop.html">T-Shirts</a></li>
                                    <li><a href="shop.html">Polo</a></li>
                                    <li><a href="shop.html">Shirts</a></li>
                                    <li><a href="shop.html">Jackets</a></li>
                                    <li><a href="shop.html">Trench</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Kid's Collection</li>
                                    <li><a href="shop.html">Dresses</a></li>
                                    <li><a href="shop.html">Shirts</a></li>
                                    <li><a href="shop.html">T-shirts</a></li>
                                    <li><a href="shop.html">Jackets</a></li>
                                    <li><a href="shop.html">Trench</a></li>
                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="img/bg-img/bg-6.jpg" alt="">
                                </div> -->
                            </div>
                        </li>
                        <li><a href="#">Solutions</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('carbon-projects.marketplace') }}">Marketplace</a></li>
                                <li><a href="">Climate Saas API</a></li>
                                <li><a href="">Partnerships</a></li>
                                {{-- <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single-blog.html">Single Blog</a></li>
                                <li><a href="regular-page.html">Regular Page</a></li>
                                <li><a href="contact.html">Contact</a></li> --}}
                            </ul>
                        </li>
                        <li><a href="blog.html">Resources</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="single-product-details.html">Product Details</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single-blog.html">Single Blog</a></li>
                                <li><a href="regular-page.html">Regular Page</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Sell</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="single-product-details.html">Product Details</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single-blog.html">Single Blog</a></li>
                                <li><a href="regular-page.html">Regular Page</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <div class="favourite-area">
                {{-- <a href="#"><img src="build/assets/img/core-img/heart.svg" alt=""></a> --}}
            </div>
            <!-- User Login Info -->
            <nav>
            <div class="user-login-info">
                {{-- <img src="build/assets/img/core-img/user.svg" alt=""> --}}
                {{-- <ul class="dropdown">
                    <li><a href="">Login</a></li>
                    <li><a href="">Register</a></li>
                    <li><a href="">My account</a></li>
                    <li><a href="">Summary</a></li>
                    <li><a href="">Transactions</a></li>
                    <li><a href="">My projects</a></li>
                </ul> --}}
                {{-- Login --}}
                {{-- Login --}}
                <a href="{{ route('login') }}" class="px-4 py-2 text-black hover:text-gray-600">
                    Log in
                </a>
                {{-- Register --}}
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-4 py-2 text-black hover:text-gray-600">
                    Register
                </a>
                @endif
            </div>
        </nav>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="build/assets/img/core-img/bag.svg" alt=""> <span>3</span></a>
            </div>
        </div>

    </div>
</header>