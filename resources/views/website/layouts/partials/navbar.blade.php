@php
    $general = getGeneral();
@endphp
<!-- Navbar -->
<header class="navbar__header" id="navbar">
    <!-- Message Div -->
    <div class="message">
        <div class="container message__container">
            <p class="messsage__content">
                FREE SHIPPING FOR ORDERS OVER RS: 10,000
            </p>
            <div class="message__social-wrapper">
                <a href="{{ $general->facebook }}" target="_blank">
                    <img src="{{ asset('assets/website') }}/images/fb.svg" alt="Facebook" class="social__img"/>
                </a>
                <a href="{{ $general->instagram }}" target="_blank">
                    <img src="{{ asset('assets/website') }}/images/instagram.svg" alt="Instagram" class="social__img"/>
                </a>
                <a href="{{ $general->twitter }}" target="_blank">
                    <img src="{{ asset('assets/website') }}/images/twitter.svg" alt="Twitter" class="social__img"/>
                </a>
                {{-- <a href="" class="track__myorder">
                    TRACK MY ORDER
                </a> --}}
            </div>
        </div>
    </div>
    <!-- /Message Div -->
    <nav class="navbar" >
        <div class="container navbar__container">
            <!-- Mobile Hamburger Menu -->
            <button class="btn hamburger__btn">
                <img src="{{ asset('assets/website/images/menu-ico.svg') }}" alt="Hamburger" class="hamburger__ico">
            </button>
            <!-- /Mobile Hamburger Menu -->
            <!-- Logo -->
            <div class="navbar__brand">
                <a href="{{ route('website.home.index') }}">
                    <img src="{{ asset('storage/'. $general->logo) }}" alt="{{ $general->name }}" class="navbar__logo">
                </a>
            </div>
            <!-- /Logo -->

            <!-- Navbar Menu -->
            <ul class="navbar__menu">
                <li><a href="{{ route('website.home.index') }}">Home</a></li>
                <li><a href="{{ route('website.home.shop') }}">Shop</a></li>
                {{-- <li><a href="{{ route('website.home.english') }}">English</a></li> --}}
                <li><a href="{{ route('website.home.contact') }}">Contact Us</a></li>
            </ul>
            <!-- /Navbar Menu -->

            <!-- Search and User Section -->
            <div class="navbar__right">
                <!-- Seacrh Input -->
                <div class="navbar__search-wrapper">
                    <input type="text" class="navbar__search-input"  id="navbar__search-input"
                    placeholder="What are you looking for"
                    />
                    <img src="{{ asset('assets/website/images/search-icon.svg') }}" alt="Magnifier" class="navbar__search-icon">
                    <div class="search__books">
                        <div class="search__books-wrapper" id="bookSearchWrapper">

                        </div>
                    </div>
                </div>
                <!-- /Seacrh Input -->

                <!-- Navabr Cart Section -->
                <div class="navbar__cart-wrapper">
                    <span class="mobile__search-icon">
                        <a href="{{ route('website.home.search') }}">
                            <img src="{{ asset('assets/website/') }}/images/search-icon.svg" alt="Wish List">
                        </a>
                    </span>
                    <a href="{{ route('website.wishlist.index') }}" class="desktop__wishlist nav__detail-menu">
                        <img src="{{ asset('assets/website/') }}/images/whishlist.svg" alt="Wish List">
                        <div class="nav__detail">
                            <span class="nav__detail-light">My</span>
                            <span class="nav__detail-dark">Wish list</span>
                        </div>
                    </a>
                    <a href="javascript:;" id="openCartModal" style="position: relative" class="nav__detail-menu">
                        <img src="{{ asset('assets/website/') }}/images/cart.svg" alt="Cart">
                        <div class="nav__detail">
                            <span class="nav__detail-light">My Cart</span>
                            <span class="nav__detail-dark" id="cart__total">Rs.{{ getCartTotal() }}</span>
                        </div>
                        <span class="cart__count" id="cart__count">{{ getCartCount() }}</span>
                    </a>
                    <span class="desktop__user" data-id="0" >
                        @auth
                        <a href="{{ route('website.profile.index') }}">
                            <span class="nav__detail-menu">
                                <img src="{{ asset('assets/website/') }}/images/user.svg" alt="User">
                                <div class="nav__detail">
                                    <span class="nav__detail-light">{{ Auth::user()->fname }}</span>
                                    <span class="nav__detail-dark">Your Account</span>
                                </div>
                            </span>
                        </a>
                        @else
                        <a href="{{ route('website.auth.login') }}">
                            <span class="nav__detail-menu">
                                <img src="{{ asset('assets/website/') }}/images/user.svg" alt="User">
                                <div class="nav__detail">
                                    <span class="nav__detail-light">Sign In</span>
                                    <span class="nav__detail-dark">Your Account</span>
                                </div>
                            </span>
                        </a>
                        @endauth
                        {{-- Login Popup --}}
                        {{-- <div class="login__popup d-none">
                            <form action="#" class="login__popup-form">
                                <div class="form-group">
                                    <label for="" class="lable">Email</label>
                                    <input type="email" class="form-control" placeholder="example@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="" class="lable">Password</label>
                                    <input type="email" class="form-control" placeholder="********">
                                </div>
                                <div class="form-group form-groupbtn">
                                    <button class="btn book__addtocart-btn btn-submit">Log In</button>
                                    <a href="{{ route('website.auth.forgot-password') }}" class="forgot-password">forgot your password?</a>
                                </div>

                                <div class="form-group form-groupbtn">
                                    <p class="register__alert">Not have a Account? <a href="{{ route('website.auth.register') }}" style="  color: #0053A8;">Create New</a></p>
                                </div>
                            </form>
                        </div> --}}
                        {{-- /End Login Popup --}}
                    </span>
                </div>
                <!-- Navabr Cart Section -->
            </div>
        </div>
    </nav>
</header>
<!-- /Navbar -->

<!----Mobile SideBar---->
<div class="mb__sidebar-wrapper d-none">
    <i class="fas fa-close sidebar__close"></i>
    <div class="mb__sidebar">
        <div class="mb__tabs">
            <a href="javascript:;" class="mb__tabs-link mb_active" data-id="#mb_menu" id="#mb_settings">Menu</a>
            <a href="javascript:;" class="mb__tabs-link" data-id="#mb_settings" id="#mb_menu">Categories</a>
        </div>
        <div class="mb__tabs-content mb_menu_active" id="mb_menu">
            <ul class="mb__menu ">
                <li><a href="{{ route('website.home.index') }}">Home</a></li>
                <li><a href="{{ route('website.home.shop') }}">Shop</a></li>
                <li><a href="{{ route('website.home.english') }}">English</a></li>
                <li><a href="{{ route('website.home.contact') }}">Contact Us</a></li>
            </ul>
            <hr>
            <h4>Settings</h4>
            <hr>
            <ul class="mb__menu ">
                <li><a href="{{ route('website.cart.index') }}">My Cart</a></li>
                <li><a href="{{ route('website.wishlist.index') }}">Wishlist</a></li>
                @auth
                <li><a href="{{ route('website.profile.index') }}">Profile</a></li>
                <li><a href="{{ route('website.auth.logout') }}">Logout</a></li>
                @else
                <li><a href="{{ route('website.auth.login') }}">Login</a></li>
                <li><a href="{{ route('website.auth.register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
        <div class="mb__tabs-content " id="mb_settings">
            @php $categoriesList = getAllCategories(); @endphp
            <ul class="mb__menu mb__menu_categories">
                @foreach ($categoriesList as $category)
                <li>
                    <a href="{{ route('website.home.category-detail-view', $category->slug) }}">
                        <p>{{ $category->name }}</p>
                        <span class="category__count">
                            ({{$category->books->count()}})
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!----/Mobile SideBar---->
