@php
    $general = getGeneral();
@endphp
<header class="header-area">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">
        <!-- header top start -->
        <div class="header-top bdr-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="welcome-message">
                            <p>FREE SHIPPING FOR ORDERS OVER RS: 10,000</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="header-top-settings">
                            <ul class="nav align-items-center justify-content-end">
                                <li>
                                    <a href="{{ $general->facebook }}" target="_blank" data-bs-toggle="tooltip"
                                        title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $general->twitter }}" target="_blank" data-bs-toggle="tooltip"
                                        title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $general->instagram }}" target="_blank" data-bs-toggle="tooltip"
                                        title="Instagram"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header top end -->

        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center">

                    <!-- start logo area -->
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{ route('website.home.index') }}">
                                <img src="{{ asset('storage/' . $general->logo) }}" alt="{{ $general->name }}">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-7">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li class="active">
                                            <a href="{{ route('website.home.index') }}">Home</a>
                                        </li>
                                        <li class="static">
                                            <a href="{{ route('website.home.shop') }}">Shop</a>
                                        </li>
                                        <li><a href="{{ route('website.home.contact') }}">Contact Us</a></li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-3">
                        <div class="header-configure-wrapper">
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li>
                                        <a href="{{ route('website.home.search') }}" class="offcanvas-btn">
                                            <i class="lnr lnr-magnifier"></i>
                                        </a>
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="lnr lnr-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <li><a href="{{ route('website.auth.login') }}">login</a></li>
                                            <li><a href="{{ route('website.auth.register') }}">register</a></li>
                                            <li><a href="{{ route('website.profile.index') }}">my account</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('website.wishlist.index') }}">
                                            <i class="lnr lnr-heart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="minicart-btn" id="openCartModal">
                                            <i class="lnr lnr-cart"></i>
                                            <div class="notification" id="cart__count">{{ getCartCount() }}</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->

    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="{{ route('website.home.index') }}">
                                <img src="{{ asset('storage/' . $general->logo) }}" alt="{{ $general->name }}"
                                    style="height: 50px">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="{{ route('website.cart.index') }}">
                                    <i class="lnr lnr-cart"></i>
                                </a>
                            </div>
                            <div class="mobile-menu-btn">
                                <div class="off-canvas-btn">
                                    <i class="lnr lnr-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
    <!-- mobile header end -->
</header>

<aside class="off-canvas-wrapper">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="lnr lnr-cross"></i>
        </div>

        <div class="off-canvas-inner">

            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item">
                            <a href="{{ route('website.home.index') }}">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('website.home.shop') }}">Shop</a>
                        </li>
                        <li class="mega-title menu-item">
                            <a href="{{ route('website.home.contact') }}">Contact Us</a>
                        </li>
                        <li class="mega-title menu-item">
                            <a href="{{ route('website.home.search') }}">Search Product</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->

            <div class="mobile-settings">
                <ul class="nav">
                    <li>
                        <div class="dropdown mobile-top-dropdown">
                            <a href="#" class="dropdown-toggle" id="myaccount" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                My Account
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="myaccount">
                                <a class="dropdown-item" href="{{ route('website.profile.index') }}">my account</a>
                                <a class="dropdown-item" href="{{ route('website.auth.login') }}"> login</a>
                                <a class="dropdown-item" href="{{ route('website.auth.login') }}">register</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- offcanvas widget area start -->
            <div class="offcanvas-widget-area">
                <div class="off-canvas-contact-widget">
                    <ul>
                        <li><i class="fa fa-mobile"></i>
                            <a href="#">0123456789</a>
                        </li>
                        <li><i class="fa fa-envelope-o"></i>
                            <a href="#">info@yourdomain.com</a>
                        </li>
                    </ul>
                </div>
                <div class="off-canvas-social-widget">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
            <!-- offcanvas widget area end -->
        </div>
    </div>
</aside>
