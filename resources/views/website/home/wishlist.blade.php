@extends('website.layouts.app')
@section('title', 'Your Wishlist - Kitchen Designer')

@section('content')
@push('styles')
    <style>
        .wishlist__addto-cart{
            background: #0053A8;
            border-radius: 2px;
            font-size: 14px !important;
            padding: 9px 14px !important;
            width: auto;
            height: auto;
            margin: 0px !important;
    }
    </style>
@endpush
<!-- Breadcrumb Section -->
<header class="breadcrumb">
    <div class="container breadcrumb__container">
        <a href="{{ route('website.home.index') }}" class="breadcrumb__link">Home</a>
        <a href="javascript:;">
            <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
        </a>
        <a href="" class="breadcrumb__link">Wish List</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

@if ($wishlists->count())
    <!-- Cart Items Section -->
<section class="cart">
    <div class="container cart__container wishlist__desktop-container">
        <table class="cart__table">
            <thead class="cart__thead">
                <tr>
                    <th align="left">Product</th>
                    <th>Unit Price</th>
                    <th>Stok Status</th>
                    <th>Action</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody class="cart__body" id="wishListBody">
                @foreach ($wishlists as $wishlist)
                <tr>
                    <td>
                        <div class="cart__item">
                            <div class="cart__item-img">
                                <a href="{{ route('website.home.book-detail-view', $wishlist->book->slug) }}">
                                    <img src="{{ asset('storage/' . $wishlist->book->images[0]->filename) }}" alt="{{ $wishlist->book->name }}">
                                </a>
                            </div>
                            <p class="cart__item-name"><a href="{{ route('website.home.book-detail-view', $wishlist->book->slug) }}">{{ $wishlist->book->name }}</a></p>
                        </div>
                    </td>
                    <td>Rs.{{$wishlist->book->special_price != $wishlist->book->price ? $wishlist->book->special_price : $wishlist->book->price}}</td>
                    <td>In Stock</td>
                    <td>
                        <input type="hidden" name="id" value="{{ $wishlist->id }}">
                        <input type="hidden" name="book_id" value="{{ $wishlist->book_id }}">
                        <button class="btn book__addtocart-btn quick__btn wishlist__addto-cart" id="addToCartWishList">Add To Cart</button>
                    </td>
                    <td><i class="fa fa-trash" style="cursor: pointer;color:red" id="removeItemFromWishList" data-id="{{ $wishlist->id }}"></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn book__addtocart-btn quick__btn" id="addAllToCart">Add All To Cart</button>
        <button class="btn buy_now-btn quick__btn" id="clearWishList">Clear Wishlist</button>
    </div>
    <div class="container cart__container wishlist__mobile-container">
        <div class="wishlist__mobile-header" style="display: flex;justify-content:space-between;align-items:center;border-bottom: 2px solid #626262;padding:10px 0px;">
            <h4>Your Wishlist</h4>
            <button class="btn buy_now-btn quick__btn" id="addAllToCart" style="margin: 0">Add All To Cart</button>
        </div>
        <div class="cart__wrapper-container">
            @foreach ($wishlists as $wishlist)
            <div class="cart__item-wrapper" style="border-bottom: 1px solid">
                <div class="cart__item-image">
                    <a href="{{ route('website.home.book-detail-view', $wishlist->book->slug) }}">
                        <img src="{{ asset('storage/' . $wishlist->book->images[0]->filename)}}" alt="{{ $wishlist->book->name }}">
                    </a>
                </div>
                <div class="cart__info">
                    <p class="cart__item-name">
                    <a href="{{ route('website.home.book-detail-view', $wishlist->book->slug) }}">{{ $wishlist->book->name }}</a>
                    </p>
                    <p class="cart__item-price">
                        <input type="hidden" name="id" value="{{ $wishlist->id }}">
                        <input type="hidden" name="book_id" value="{{ $wishlist->book_id }}">
                        <button class="btn book__addtocart-btn quick__btn wishlist__addto-cart" id="addToCartWishList">Add To Cart</button>
                        <i class="fa fa-trash" style="cursor: pointer;color:red;margin-left:10px" id="removeItemFromWishList" data-id="{{ $wishlist->id }}"></i>
                    </p>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Cart Items Section -->
@else
<section class="cart">
    <div class="container cart__container">

        <h2>Your Wishlist</h2>
        <br>
        <div style="display: flex;flex-direction:column;gap:1rem">
            <p>Your wishlist is empty</p>
            <p>Enable cookies to use the wishlist</p>
            <p>Continue browsing <a style="text-decoration: underline;color:rgb(30, 30, 227)" href="{{ route('website.home.shop') }}">here</a>.</p>
        </div>
        <br>
    </div>
</section>
@endif

@include('website.cart.js.index')
@endsection
