<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{{ route('home') }}"><img src="{{ asset('build/assets/img/core-img/logo.png') }}" alt=""></a>
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
                                    <li><a href="#">Companies</a></li>
                                    <li><a href="#">Individuals</a></li>
                                    <li><a href="#">Calculators</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                                <!-- <ul class="single-mega cn-col-4">
                                    <li class="title">Men's Collection</li>
                                    <li><a href="#">T-Shirts</a></li>
                                    <li><a href="#">Polo</a></li>
                                    <li><a href="#">Shirts</a></li>
                                    <li><a href="#">Jackets</a></li>
                                    <li><a href="#">Trench</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Kid's Collection</li>
                                    <li><a href="#">Dresses</a></li>
                                    <li><a href="#">Shirts</a></li>
                                    <li><a href="#">T-shirts</a></li>
                                    <li><a href="#">Jackets</a></li>
                                    <li><a href="#">Trench</a></li>
                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="img/bg-img/bg-6.jpg" alt="">
                                </div> -->
                            </div>
                        </li>
                        <li><a href="#">Solutions</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('projects.marketplace') }}">Marketplace</a></li>
                                <li><a href="#">Climate Saas API</a></li>
                                <li><a href="#">Partnerships</a></li>
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
                                <li><a href="#">Shop</a></li>
                                <li><a href="#">Product Details</a></li>
                                <li><a href="#">Checkout</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Single Blog</a></li>
                                <li><a href="#">Regular Page</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Sell</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="#">Shop</a></li>
                                <li><a href="#">Product Details</a></li>
                                <li><a href="#">Checkout</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Single Blog</a></li>
                                <li><a href="#">Regular Page</a></li>
                                <li><a href="#">Contact</a></li>
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
            {{-- <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div> --}}
            <!-- Favourite Area -->
            <div class="favourite-area">
                {{-- <a href="#"><img src="build/assets/img/core-img/heart.svg" alt=""></a> --}}
            </div>
            <!-- User Login Info -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid px-2">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            @auth
                                <!-- Nếu người dùng đã đăng nhập -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle fs-3 me-2"></i>
                                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg p-3" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">My Account</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Log out
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <!-- Form đăng xuất -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <!-- Nếu người dùng chưa đăng nhập -->
                                <li class="nav-item">
                                    <a class="px-4 py-2 text-black hover:text-gray-600" href="{{ route('login') }}">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="px-4 py-2 text-black hover:text-gray-600" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Cart Area -->
            <a href="{{ route('user.cart.index') }}" class="position-relative ms-1 d-flex align-items-center px-3">
                <i class='fa fa-shopping-bag'></i>
                {{-- <span id="cart-count" class="position-absolute top-5 start-50 translate-middle badge rounded-pill bg-danger"> --}}
                    @php
                        // Lấy số lượng từ session khi tải trang
                        $cartItemsCount = session('cartItemsCount', 0); 
                    @endphp
                </span>
            </a>
        </div>
</header>
