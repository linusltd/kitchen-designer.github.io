@extends('new-website.new-layouts.new-app')
@section('title', 'Kitchen Designer - Pakistan No. 1 Online Kitchen Store')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Kitchen Designer - Pakistan No. 1 Online Kitchen Store">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kitchen Designer - Pakistan No. 1 Online Kitchen Store">
    <meta name="twitter:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <link rel="canonical" href="{{ Request::url() }}">
    <meta name="description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta property="article:publisher" content="https://www.facebook.com/KitabJahaan">
@endsection
@section('content')

    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            @foreach ($sliders as $slider)
                <a
                    @if ($slider->redirect == 0) href="{{ route('website.home.book-detail-view', $slider->book->slug) }}"
                @elseif($slider->redirect == 1)
                href="{{ route('website.home.category-detail-view', $slider->category->slug) }}"
                @elseif($slider->redirect == 2)
                href="{{ route('website.home.index') }}{{ $slider->url }}" @endif>


                    <div class="hero-single-slide" style="background-color: {{ $slider->color }}">
                        <div class="hero-slider-item bg-img"
                            data-bg="@mobile
{{ asset('storage/' . $slider->mobile_image) }}
@elsemobile
{{ asset('storage/' . $slider->image) }}
@endmobile">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Products Section-->
    <div class="shop-main-wrapper section-space">
        <div class="container">
            <div class="row">
                <!-- shop main wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            @foreach ($categoriesWithProducts as $book)
                                <!-- product single item start -->
                                <div class="col-md-3 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('website.home.book-detail-view', $book->slug) }}">
                                                <img class="pri-img"
                                                    src="{{ asset('storage/' . $book->images[0]->filename) }}"
                                                    alt="{{ $book->title }}" />
                                                <img class="sec-img"
                                                    src="{{ asset('storage/' . $book->images[0]->filename) }}"
                                                    alt="{{ $book->title }}" />
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
                                                    id="addToWishList" data-id="{{ $book->id }}"
                                                    title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                        data-bs-toggle="tooltip" id="quickView"
                                                        data-id="{{ $book->id }}" data-bs-placement="left"
                                                        title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                            </div>
                                            <div class="box-cart">
                                                <button type="button" class="btn btn-cart" id="addToCartBtn"
                                                    data-id="{{ $book->id }}">
                                                    add to cart
                                                </button>
                                            </div>
                                        </figure>
                                        <div class="product-caption">
                                            <div class="product-identity">
                                                @if ($book->reviews->count())
                                                    @php
                                                        $averageRating = $book->reviews->avg('ratings');
                                                        $fullStars = floor($averageRating);
                                                        $halfStar = $averageRating - $fullStars;
                                                        $emptyStars = 5 - $fullStars - ceil($halfStar);
                                                    @endphp

                                                    <div class="rating">
                                                        @for ($i = 1; $i <= $fullStars; $i++)
                                                            <img src="{{ asset('assets/website') }}/images/star.svg"
                                                                class="" />
                                                        @endfor

                                                        @if ($halfStar > 0)
                                                            {{-- Half Star --}}
                                                            <img src="{{ asset('assets/website') }}/images/hald_star.svg"
                                                                class="ratin__star" />
                                                        @endif
                                                        {{-- Full Star --}}
                                                        @for ($i = 1; $i <= $emptyStars; $i++)
                                                            <img src="{{ asset('assets/website') }}/images/bland_star.svg"
                                                                class="ratin__star" />
                                                        @endfor
                                                    </div>
                                                @else
                                                    <div class="ratings">
                                                        <span><i class="lnr lnr-star"></i></span>
                                                        <span><i class="lnr lnr-star"></i></span>
                                                        <span><i class="lnr lnr-star"></i></span>
                                                        <span><i class="lnr lnr-star"></i></span>
                                                        <span><i class="lnr lnr-star"></i></span>
                                                    </div>
                                                @endif

                                            </div>
                                            <p class="product-name">
                                                <a
                                                    href="{{ route('website.home.book-detail-view', $book->slug) }}">{{ $book->name }}</a>
                                            </p>
                                            <div class="price-box">
                                                <span class="price-regular">Rs.{{ $book->special_price }}</span>
                                                @if ($book->price !== $book->special_price)
                                                    <span class="price-old"><del>Rs.{{ $book->price }}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                </div>
                                <!-- product single item start -->
                            @endforeach

                        </div>
                        <!-- product item list wrapper end -->
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
@endsection
