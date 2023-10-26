@extends('website.layouts.app')
@section('title', $book->title)
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="{{ $book->title }}">
    <meta property="og:type" content="product">
    <meta property="og:description"
        content="{{ 'Author: ' . $authors . ': Pages: ' . $book->pages . ': UrduBinding: ' . $book->binding . ': CoverSize: ' . $book->size . ': Volume: ' . $book->volume }}">

    <meta property="og:price:amount"
        content="{{ $book->special_price != $book->price ? $book->special_price : $book->price }}">
    <meta property="og:price:currency" content="PKR">

    <meta property="og:image" content="{{ asset('storage/' . $book->images[0]->filename) }}">
    <meta property="og:image:secure_url" content="{{ asset('storage/' . $book->images[0]->filename) }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $book->title }}">
    <meta name="twitter:description"
        content="{{ 'Author: ' . $authors . ': Pages: ' . $book->pages . ': UrduBinding: ' . $book->binding . ': CoverSize: ' . $book->size . ': Volume: ' . $book->volume }}">
    <meta name="description"
        content="{{ 'Author: ' . $authors . ': Pages: ' . $book->pages . ': UrduBinding: ' . $book->binding . ': CoverSize: ' . $book->size . ': Volume: ' . $book->volume }}">
    <link rel="canonical" href="{{ Request::url() }}">

@endsection
@push('styles')
    <!-- Basic Styles For Gallery -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/website/js/jquery-zoom-image-carousel/style.css') }}">
@endpush
@section('title')
    {{ $book->name }}
@endsection
@section('content')
    <!-- Breadcrumb Section -->
    <header class="breadcrumb">
        <div class="container breadcrumb__container">
            <a href="{{ route('website.home.index') }}" class="breadcrumb__link">Home</a>
            <a href="javascript:;">
                <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
            </a>
            <a href="{{ route('website.home.category-detail-view', $book->categories[0]->slug) }}"
                class="breadcrumb__link">{{ $book->categories->count() ? $book->categories[0]->name : '' }}</a>
            <a href="javascript:;">
                <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
            </a>
            <a href="" class="breadcrumb__link">{{ $book->name }}</a>
        </div>
    </header>
    <!-- /Breadcrumb Section -->

    <!-- Product Details Wrapper -->
    <section class="productdetail">
        <div class="container productdetail__container">
            {{-- Product Image And Parameters --}}
            <div class="qucik__view-wrapper">
                <div class="quick__view-left">
                    <!-- Primary carousel image -->
                    <div class="show__wrapper">
                        <div class="show" href="1.jpg">
                            <img src="{{ asset('storage/' . $book->images[0]->filename) }}" id="show-img">
                        </div>
                    </div>
                    <!-- Secondary carousel image thumbnail gallery -->
                    <div class="small-img">
                        <img src="{{ asset('assets/website') }}/images/next-icon.svg" class="icon-left" alt=""
                            id="prev-img">
                        <div class="small-container">
                            <div id="small-img-roll">
                                @foreach ($book->images->where('type', 1) as $image)
                                    <img src="{{ asset('storage/' . $image->filename) }}" class="show-small-img"
                                        alt="">
                                @endforeach
                            </div>
                        </div>
                        <img src="{{ asset('assets/website') }}/images/next-icon.svg" class="icon-right" alt=""
                            id="next-img">
                    </div>
                </div>
                <div class="quick__view-right">
                    <h2 class="quick__view-title">{{ $book->name }}</h2>
                    <div class="quick__spacer"></div>
                    {{-- Book Reivews --}}
                    <div class="quick__view-reviews">
                        @if ($book->reviews->count())
                            @php
                                $averageRating = $book->reviews->avg('ratings');
                                $fullStars = floor($averageRating);
                                $halfStar = $averageRating - $fullStars;
                                $emptyStars = 5 - $fullStars - ceil($halfStar);
                            @endphp
                            <div class="ratings">
                                @for ($i = 1; $i <= $fullStars; $i++)
                                    <img src="{{ asset('assets/website') }}/images/star.svg" class="ratin__star" />
                                @endfor

                                @if ($halfStar > 0)
                                    {{-- Half Start --}}
                                    <img src="{{ asset('assets/website') }}/images/hald_star.svg" class="ratin__star" />
                                @endif

                                @for ($i = 1; $i <= $emptyStars; $i++)
                                    {{-- Full Start --}}
                                    <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="ratin__star" />
                                @endfor
                            </div>
                            <span class="quick__reviews">({{ $book->reviews->count() }} review)</span>
                        @endif
                    </div>
                    {{-- /Book Reivews --}}

                    {{-- Book Pricing --}}
                    <p class="quick__view-prices">
                        @if ($book->price !== $book->special_price)
                            <span class="quick__view-discount">Rs.{{ number_format($book->price, 2) }}</span>
                        @endif
                        <span class="quick__view-price">Rs.{{ number_format($book->special_price, 2) }}</span>
                    </p>
                    {{-- /Book Pricing --}}

                    <div class="quick__spacer"></div>

                    <div class="quick__cart-wrapper">
                        @if ($book->in_stock == 0)
                            <span class="in__stock">In Stock</span>
                        @else
                            <span class="out__of-stock">Out Of Stock</span>
                        @endif

                        <div class="quick__qty">
                            <div class="qty__wrapper">
                                <button class="minus__btn" id="deacreaseQuanatity"><i class="fas fa-minus"></i></button>
                                <input type="text" name="quantity" id="quantity" value="1" readonly />
                                <button class="plus__btn" id="increaseQuantity"><i class="fas fa-plus"></i></button>
                            </div>
                            @if ($book->in_stock == 0)
                                <button class="btn book__addtocart-btn quick__btn" id="addToCartBtnQuickView"
                                    data-id="{{ $book->id }}">Add To Cart</button>
                                <button class="btn book__addtocart-btn quick__btn buy_now-btn" id="addToCartBtnQuickView"
                                    data-id="{{ $book->id }}">Buy Now</button>
                            @else
                                <button class="btn book__addtocart-btn quick__btn">Add To Cart</button>
                                <button class="btn book__addtocart-btn quick__btn buy_now-btn">Buy Now</button>
                            @endif
                        </div>
                    </div>
                    <div class="quick__spacer"></div>
                    <div class="quick__view-info">
                        <p><span>SKU: </span> {{ $book->sku }}</p>
                        <div>
                            {!! $book->highlights !!}
                        </div>
                        {{-- <p><span>Author: </span>  {{ $authors }}</p>
                    <p><span>Pages: </span> {{ $book->pages }}</p>
                    <p><span>Cover: </span> {{ $book->binding }}</p>
                    <p><span>Size: </span> {{ $book->size }}</p>
                    <p><span>Categories: </span> {{ $categories }}</p> --}}
                    </div>
                    <div class="quick__spacer"></div>
                    <div class="quick__view-socials">
                        <div class="share__wrapper">
                            <strong>Share This Product</strong>
                            <div class="quick__view-socials--wrapper">
                                <div class="tooltip" style="display: block !important">
                                    <a href="https://www.facebook.com/sharer.php?u={{ Request::url() }}" target="_blank">
                                        <img src="{{ asset('assets/website') }}/images/fb1.svg" alt="Facebook"
                                            class="social__img" />
                                    </a>
                                    <div class="top">
                                        <p>Share on Facebook</p>
                                        <i></i>
                                    </div>
                                </div>
                                <div class="tooltip" style="display: block !important">
                                    <a href="https://twitter.com/intent/tweet?text={{ $book->name }}&url={{ Request::url() }}"
                                        target="_blank">
                                        <img src="{{ asset('assets/website') }}/images/twit.svg" alt="Twitter"
                                            class="social__img" />
                                    </a>
                                    <div class="top">
                                        <p>Share on Twitter</p>
                                        <i></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quick_verticle__spacer"></div>
                        <p class="quick__view-wishlist" id="addToWishList" data-id="{{ $book->id }}">
                            <img src="{{ asset('assets/website') }}/images/heart.svg" alt="">
                            Add to Wishlist
                        </p>

                    </div>
                </div>
            </div>
            {{-- /End Product Image And Parameters --}}

            {{-- Product Description and Reviews Tab --}}
            <div class="product__tab-wrapper">
                <div class="tab-links">
                    <p class="tab-link tab-active" id="description">Description</p>
                    <p class="tab-link" id="review">Review</p>
                </div>
                <div class="tabs">
                    <div class="tab" id="tab-description">
                        {!! $book->description !!}
                    </div>
                    <div class="tab d-none" id="tab-review">
                        <div class="product__review-wrapper">
                            <div class="product__reviews">
                                @if ($book->reviews->count())
                                    <h2 class="product__reviews-title">
                                        {{ $book->reviews->count() }} reviews for {{ $book->name }}
                                    </h2>
                                    <div id="#reviews-compoent">
                                        @include('website.home.reviews')
                                    </div>
                                @else
                                    <p>No Review Found for {{ $book->name }}. Be the first to review this product.</p>
                                @endif

                            </div>
                            <div class="product__addreview">
                                <h1 class="reivew_form_title">Write a review</h1>
                                <form action="" class="add__review-form" id="add__review-form"
                                    onsubmit="return false">
                                    @csrf
                                    <div class="reviewmessage"></div>
                                    <div class="form-group">
                                        <label for="" class="lable">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name"
                                            @auth
value="{{ Auth::user()->fname }}" @endauth>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="lable">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            @auth
value="{{ Auth::user()->email }}" @endauth>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="lable">Rating</label>
                                        <div class="stars">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5"></label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4"></label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3"></label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2"></label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="lable">Your Review (Body of Review 1500)</label>
                                        <textarea name="review" id="review" cols="30" rows="5" placeholder="Write your comment here"></textarea>
                                    </div>
                                    <div class="form-group form-groupbtn">
                                        <button type="button" class="btn auth__btn" id="submitReview">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Product Description and Reviews Tab --}}


            {{-- Related Products --}}
            <div class="books__container">
                <div class="books__header">
                    <h3 class="books__category-title" style="text-align: left">Related Products</h3>
                </div>
                @php $relatedProducts = getRandomProducts($book->id, 6); @endphp
                <div class="row col-8">
                    @foreach ($relatedProducts as $item)
                        <article class="book__card">
                            <div class="book__img-wrapper">
                                <a href="{{ route('website.home.book-detail-view', $item->slug) }}">
                                    <img src="{{ asset('storage/' . $item->images[0]->filename) }}"
                                        alt="{{ $item->name }}" class="book__img">

                                </a>
                            </div>
                            <div class="book__info-wrapper">
                                <div class="ratings-wrapper">
                                    @if ($book->reviews->count())
                                        @php
                                            $averageRating = $book->reviews->avg('ratings');
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars;
                                            $emptyStars = 5 - $fullStars - ceil($halfStar);
                                        @endphp
                                        <div class="ratings-wrapper">
                                            @for ($i = 1; $i <= $fullStars; $i++)
                                                <img src="{{ asset('assets/website') }}/images/star.svg"
                                                    class="" />
                                            @endfor

                                            @if ($halfStar > 0)
                                                {{-- Half Star --}}
                                                <img src="{{ asset('assets/website') }}/images/star.svg"
                                                    class="" />
                                            @endif
                                            {{-- Full Star --}}
                                            @for ($i = 1; $i <= $emptyStars; $i++)
                                                <img src="{{ asset('assets/website') }}/images/star.svg"
                                                    class="" />
                                            @endfor
                                        </div>
                                    @else
                                        <div class="ratings-wrapper">
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('website.home.book-detail-view', $item->slug) }}"
                                    class="book__name">{{ $item->name }}</a>

                                <div class="book__price">
                                    @if ($item->price !== $item->special_price)
                                        <span class="book__real__price">
                                            Rs.{{ $item->price }}
                                        </span>
                                    @endif
                                    <span class="book__special__price">Rs.{{ $item->special_price }}</span>
                                </div>
                                <button class="btn book__addtocart-btn" id="addToCartBtn"
                                    data-id="{{ $item->id }}">Add To Cart</button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            {{-- /Related Products --}}

            {{-- Other Products --}}
            <div class="books__container">
                <div class="books__header">
                    <h3 class="books__category-title" style="text-align: left">We found other books you might like!</h3>
                </div>
                @php $randomProducts = getRandomProducts($book->id, 6); @endphp
                <div class="row col-8">
                    @foreach ($randomProducts as $item)
                        <article class="book__card">
                            <div class="book__img-wrapper">
                                <a href="{{ route('website.home.book-detail-view', $item->slug) }}">
                                    <img src="{{ asset('storage/' . $item->images[0]->filename) }}"
                                        alt="{{ $item->name }}" class="book__img">

                                </a>
                            </div>
                            <div class="book__info-wrapper">
                                <div class="ratings-wrapper">
                                    @if ($book->reviews->count())
                                        @php
                                            $averageRating = $book->reviews->avg('ratings');
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars;
                                            $emptyStars = 5 - $fullStars - ceil($halfStar);
                                        @endphp
                                        <div class="ratings-wrapper">
                                            @for ($i = 1; $i <= $fullStars; $i++)
                                                <img src="{{ asset('assets/website') }}/images/star.svg"
                                                    class="" />
                                            @endfor

                                            @if ($halfStar > 0)
                                                {{-- Half Star --}}
                                                <img src="{{ asset('assets/website') }}/images/star.svg"
                                                    class="" />
                                            @endif
                                            {{-- Full Star --}}
                                            @for ($i = 1; $i <= $emptyStars; $i++)
                                                <img src="{{ asset('assets/website') }}/images/star.svg"
                                                    class="" />
                                            @endfor
                                        </div>
                                    @else
                                        <div class="ratings-wrapper">
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                class="" />
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('website.home.book-detail-view', $item->slug) }}"
                                    class="book__name">{{ $item->name }}</a>

                                <div class="book__price">
                                    @if ($item->price !== $item->special_price)
                                        <span class="book__real__price">
                                            Rs.{{ $item->price }}
                                        </span>
                                    @endif
                                    <span class="book__special__price">Rs.{{ $item->special_price }}</span>
                                </div>
                                <button class="btn book__addtocart-btn" id="addToCartBtn"
                                    data-id="{{ $item->id }}">Add To Cart</button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            {{-- /Other Products --}}

        </div>
    </section>
    <!-- /Product Details Wrapper -->


    @push('scripts')
        <!-- Product Image Gallery Js -->
        <script src="{{ asset('assets/website/js/jquery-zoom-image-carousel/scripts/zoom-image.js') }}"></script>
        <script src="{{ asset('assets/website/js/jquery-zoom-image-carousel/scripts/main.js') }}"></script>
    @endpush
    @include('website.home.js.index')
    @include('website.home.js.book-details')
@endsection
