@extends('new-website.new-layouts.new-app')
@section('title', 'Your Wishlist - Kitchen Designer')

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
                                <li class="breadcrumb-item active" aria-current="page">wishlist</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- wishlist main wrapper start -->
    <div class="wishlist-main-wrapper section-space">
        <div class="container">
            <!-- Wishlist Page Content Start -->
            <div class="section-bg-color">
                @if ($wishlists->count())
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Wishlist Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Stock Status</th>
                                            <th class="pro-subtotal">Add to Cart</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wishListBody">
                                        @foreach ($wishlists as $wishlist)
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a
                                                        href="{{ route('website.home.book-detail-view', $wishlist->book->slug) }}">
                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/' . $wishlist->book->images[0]->filename) }}"
                                                            alt="{{ $wishlist->book->name }}" />
                                                    </a>
                                                </td>
                                                <td class="pro-title">
                                                    <a
                                                        href="{{ route('website.home.book-detail-view', $wishlist->book->slug) }}">{{ $wishlist->book->name }}</a>
                                                </td>
                                                <td class="pro-price">
                                                    <span>Rs.{{ $wishlist->book->special_price != $wishlist->book->price ? $wishlist->book->special_price : $wishlist->book->price }}</span>
                                                </td>
                                                <td class="pro-quantity">
                                                    @if ($wishlist->in_stock == 0)
                                                        <span class="text-success">
                                                            In Stock
                                                        </span>
                                                    @else
                                                        <span class="text-danger">
                                                            Out of Stock
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="pro-subtotal">
                                                    <input type="hidden" name="id" value="{{ $wishlist->id }}">
                                                    <input type="hidden" name="book_id" value="{{ $wishlist->book_id }}">
                                                    <a href="" class="btn btn__bg" id="addToCartWishList">
                                                        Add to
                                                        Cart
                                                    </a>
                                                </td>
                                                <td class="pro-remove">
                                                    <a href="#" id="removeItemFromWishList"
                                                        data-id="{{ $wishlist->id }}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <h2>Your Wishlist</h2>
                        <br>
                        <div style="display: flex;flex-direction:column;gap:1rem">
                            <p>Your wishlist is empty</p>
                            <p>Enable cookies to use the wishlist</p>
                            <p>Continue browsing <a style="text-decoration: underline;color:rgb(30, 30, 227)"
                                    href="{{ route('website.home.shop') }}">here</a>.</p>
                        </div>
                        <br>
                    </div>
                @endif

            </div>
            <!-- Wishlist Page Content End -->
        </div>
    </div>
@endsection
