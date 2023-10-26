@extends('new-website.new-layouts.new-app')
@section('title', 'Your Shopping Cart')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Your Shopping Cart">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Shopping Cart">
    <meta name="twitter:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <link rel="canonical" href="{{ Request::url() }}">

@endsection

@section('content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home.index') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('website.home.shop') }}">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-space">
        <div class="container">
            <div class="section-bg-color">
                @if (!is_null($cart))

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart__body">
                                        @foreach ($cart_items as $item)
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a
                                                        href="{{ route('website.home.book-detail-view', $item->book->slug) }}">
                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/' . $item->book->images[0]->filename) }}"
                                                            alt="{{ $item->book->name }}" />
                                                    </a>
                                                </td>
                                                <td class="pro-title">
                                                    <a
                                                        href="{{ route('website.home.book-detail-view', $item->book->slug) }}">
                                                        {{ $item->book->name }}
                                                    </a>
                                                </td>
                                                <td class="pro-price">
                                                    <span>Rs.{{ $item->price }}</span>
                                                </td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty">
                                                        <span class="dec qtybtn" id="removeFromCartInternalBtn"
                                                            data-id="{{ $item->id }}">-</span>
                                                        <input type="text" name="" id=""
                                                            value="{{ $item->quantity }}" readonly="">
                                                        <span class="inc qtybtn" id="addToCartInternalBtn"
                                                            data-id="{{ $item->book_id }}">+</span>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span>Rs.{{ $item->total_price }}</span>
                                                </td>
                                                <td class="pro-remove">
                                                    <a href="#" id="deleteCartItem" data-id="{{ $item->id }}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->

                        </div>
                    </div>
                @else
                    <div class="row">
                        <h2>Your Cart</h2>
                        <br>
                        <div style="display: flex;flex-direction:column;gap:1rem">
                            <p>Your cart is currently empty</p>
                            <p>Enable cookies to use the shopping cart</p>
                            <p>Continue browsing <a style="text-decoration: underline;color:rgb(30, 30, 227)"
                                    href="{{ route('website.home.shop') }}">here</a>.</p>
                        </div>
                        <br>
                    </div>
                @endif
                @if (!is_null($cart))
                    <div class="row" style="margin: 20px 0">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h3>Cart Totals</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="cartItemsBillBody">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>Rs.{{ number_format($cart->items_subtotal_price, 2) }}</td>
                                            </tr>
                                            @php $delivery_charges = $cart->items_subtotal_price <= 10000 ? 300: 0; @endphp
                                            <tr>
                                                <td>Shipping</td>
                                                <td>Rs.{{ $delivery_charges }}.00</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">
                                                    Rs.{{ number_format($cart->items_subtotal_price + $delivery_charges, 2) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="{{ route('website.cart.checkout') }}" class="btn btn__bg d-block">Proceed To
                                    Checkout</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- @include('new-website.cart.js.index') --}}
    @include('new-website.cart.js.index')

@endsection
