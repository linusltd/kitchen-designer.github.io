@extends('new-website.new-layouts.new-app')
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
                                <li class="breadcrumb-item active" aria-current="page">product details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-space">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    @foreach ($book->images->where('type', 1) as $image)
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{ asset('storage/' . $image->filename) }}" alt="product-details" />
                                        </div>
                                    @endforeach

                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    @foreach ($book->images->where('type', 1) as $image)
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('storage/' . $image->filename) }}" alt="product-details" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="product-details.html">HasTech</a>
                                    </div>
                                    <h3 class="product-name">{{ $book->name }}</h3>
                                    @if ($book->reviews->count())
                                        @php
                                            $averageRating = $book->reviews->avg('ratings');
                                            $fullStars = floor($averageRating);
                                            $halfStar = $averageRating - $fullStars;
                                            $emptyStars = 5 - $fullStars - ceil($halfStar);
                                        @endphp
                                        <div class="ratings d-flex">
                                            @for ($i = 1; $i <= $fullStars; $i++)
                                                <span><i class="lnr lnr-star"></i></span>
                                            @endfor

                                            @if ($halfStar > 0)
                                                {{-- Half Start --}}
                                                <img src="{{ asset('assets/website') }}/images/hald_star.svg"
                                                    class="ratin__star" />
                                            @endif

                                            @for ($i = 1; $i <= $emptyStars; $i++)
                                                {{-- Full Start --}}
                                                <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                    class="ratin__star" />
                                            @endfor
                                            <div class="pro-review">
                                                <span>{{ $book->reviews->count() }} Reviews</span>
                                            </div>

                                        </div>
                                    @endif
                                    <div class="price-box">
                                        <span class="price-regular">Rs.{{ number_format($book->special_price, 2) }}</span>
                                        @if ($book->price !== $book->special_price)
                                            <span
                                                class="price-old"><del>Rs.{{ number_format($book->price, 2) }}</del></span>
                                        @endif
                                    </div>
                                    <div class="availability">
                                        @if ($book->in_stock == 0)
                                            <i class="fa fa-check-circle"></i>
                                            <span>in stock</span>
                                        @else
                                            <i class="fa fa-times-circle"style="color: #cc1414;"></i>
                                            <span>Out of stock</span>
                                        @endif
                                    </div>
                                    <p class="pro-desc">{!! $book->description !!}</p>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h5>qty:</h5>
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn">-</span>
                                                <input type="text" name="quantity" id="quantity" value="1"
                                                    readonly />
                                                <span class="inc qtybtn">+</span>
                                            </div>
                                        </div>
                                        @if ($book->in_stock == 0)
                                            <a class="btn btn-cart2" id="addToCartBtnQuickView" href="#"
                                                data-id="{{ $book->id }}">Add to
                                                cart</a>
                                        @else
                                            <a class="btn btn-cart2" href="#">Add to cart</a>
                                        @endif
                                    </div>


                                    <div class="useful-links">
                                        <a href="#" data-bs-toggle="tooltip" title="Wishlist" id="addToWishList" data-id="{{ $book->id }}"><i
                                                class="lnr lnr-heart"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-space pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">reviews
                                                ({{ $book->reviews->count() }})</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p>{!! $book->description !!}</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_three">
                                            <form action="" class="add__review-form" id="add__review-form"
                                                onsubmit="return false">
                                                @csrf
                                                @if ($book->reviews->count())
                                                    <h5>{{ $book->reviews->count() }} review for
                                                        <span>{{ $book->name }}</span>
                                                    </h5>
                                                    @foreach ($reviews as $item)
                                                        <div class="total-reviews">
                                                            <div class="rev-avatar">
                                                                <img src="{{ asset('assets/website/images/reviewer.jpeg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="review-box">
                                                                @php
                                                                    $averageRating = $item->ratings;
                                                                    $fullStars = floor($averageRating);
                                                                    $halfStar = $averageRating - $fullStars;
                                                                    $emptyStars = 5 - $fullStars - ceil($halfStar);
                                                                @endphp
                                                                <div class="ratings">
                                                                    @for ($i = 1; $i <= $fullStars; $i++)
                                                                        <img src="{{ asset('assets/website') }}/images/star.svg"
                                                                            class="ratin__star" />
                                                                    @endfor

                                                                    @if ($halfStar > 0)
                                                                        {{-- Half Start --}}
                                                                        <img src="{{ asset('assets/website') }}/images/hald_star.svg"
                                                                            class="ratin__star" />
                                                                    @endif

                                                                    @for ($i = 1; $i <= $emptyStars; $i++)
                                                                        {{-- Full Start --}}
                                                                        <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                                            class="ratin__star" />
                                                                    @endfor
                                                                </div>
                                                                <div class="post-author">
                                                                    <p><span>{{ $item->name }} -</span>
                                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}
                                                                    </p>
                                                                </div>
                                                                <p>{{ $item->review }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No Review Found for {{ $book->name }}. Be the first to review
                                                        this
                                                        product.</p>
                                                @endif
                                                <div class="reviewmessage"></div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Name"
                                                            @auth
value="{{ Auth::user()->fname }}" @endauth required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Email"
                                                            @auth
value="{{ Auth::user()->email }}" @endauth required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Review</label>
                                                        <textarea class="form-control" name="review" id="review" required></textarea>
                                                        <div class="help-block pt-10"><span
                                                                class="text-danger">Note:</span>
                                                            HTML is not translated!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Rating</label>
                                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                        <input type="radio" id="star1" value="1"
                                                            name="rating">
                                                        &nbsp;
                                                        <input type="radio" id="star2" value="2"
                                                            name="rating">
                                                        &nbsp;
                                                        <input type="radio" id="star3" value="3"
                                                            name="rating">
                                                        &nbsp;
                                                        <input type="radio" id="star4" value="4"
                                                            name="rating">
                                                        &nbsp;
                                                        <input type="radio" id="star5" value="5"
                                                            name="rating">
                                                        &nbsp;Good
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="sqr-btn" id="submitReview"
                                                        type="submit">Submit</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related product area start -->
    <section class="related-products section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @php $relatedProducts = getRandomProducts($book->id, 6); @endphp

                    <div class="product-carousel--4 slick-row-15 slick-sm-row-10 slick-arrow-style">
                        @foreach ($relatedProducts as $item)
                            <!-- product single item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="{{ route('website.home.book-detail-view', $item->slug) }}">
                                        <img class="pri-img" src="{{ asset('storage/' . $item->images[0]->filename) }}"
                                            alt="{{ $item->name }}">
                                        <img class="sec-img" src="{{ asset('storage/' . $item->images[0]->filename) }}"
                                            alt="{{ $item->name }}">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                            id="addToWishList" data-id="{{ $item->id }}" title="Add to wishlist"><i
                                                class="lnr lnr-heart"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"
                                            id="quickView" data-id="{{ $item->id }}"><span data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Quick View"><i
                                                    class="lnr lnr-magnifier"></i></span></a>
                                    </div>
                                    <div class="box-cart">
                                        <button type="button" class="btn btn-cart" id="addToCartBtn"
                                            data-id="{{ $item->id }}">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                                        <div class="ratings">
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                        </div>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <p class="product-name">
                                        <a
                                            href="{{ route('website.home.book-detail-view', $item->slug) }}">{{ $item->name }}</a>
                                    </p>
                                    <div class="price-box">
                                        <span class="price-regular">Rs.{{ $item->special_price }}</span>
                                        @if ($item->price !== $item->special_price)
                                            <span class="price-old"><del>Rs.{{ $item->price }}</del></span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- product single item end -->
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('new-website.home.js.book-details')
@endsection
