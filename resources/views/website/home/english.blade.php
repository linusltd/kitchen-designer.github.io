@extends('website.layouts.app')
@section('title', 'English Products')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="English Products">
<meta property="og:type" content="product.group">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="English Products">
<meta name="twitter:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<link rel="canonical" href="{{ Request::url() }}">
<meta name="description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

@endsection

@section('content')

    <!-- Header Section -->
    <header class="header">
        <div class="header__wrapper">
            <div class="container header__container">
                @foreach ($sliders as $slider)
                    <div class="header__img-wrapper slides fade" data-id="{{ $slider->color }}">
                        <a
                            @if($slider->redirect == 0)
                                href="{{ route('website.home.book-detail-view', $slider->book->slug) }}"
                            @elseif($slider->redirect == 1)
                                href="{{ route('website.home.category-detail-view', $slider->category->slug) }}"
                            @elseif($slider->redirect == 2)
                                href="{{ route('website.home.index') }}{{$slider->url}}"
                            @endif
                        >
                            @mobile
                            <img src="{{ asset('storage/' . $slider->mobile_image) }}" alt="Banner" class="header__banner">
                            @elsemobile
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="Banner" class="header__banner">
                            @endmobile
                        </a>
                    </div>
                @endforeach

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <!-- The dots/circles -->
                <div style="text-align:center" class="dot__wrapper">
                    @foreach ($sliders as $key =>  $slider)
                        <span class="dot" onclick="currentSlide({{ ++$key }})"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
    <!-- /Header Section -->

    <!-- Categories Section -->
    <div class="categories">
        <div class="container categories__container">
            <div class="categories__title">All English Products Categories
                <a href="{{ route('website.home.shop') }}" class="view__all-categories">View All</a>
            </div>
            <div class="categories__wrapper">
                @foreach ($categories as $item)
                    <div class="category__tag">
                        <a href="{{ route('website.home.category-detail-view', $item->slug) }}">
                            <span class="category__tag-name">{{ $item->name }} ({{ $item->books->count() }})</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Categories Section -->

    <!-- Products Section -->
    <section class="books">
        @foreach ($categoriesWithProducts as $category)
        <div class="container books__container">
            <div class="books__header">

                <h3 class="books__category-title">{{ $category->name }}</h3>

            </div>
            <div class="row col-8">
                @foreach ($category->books as $book)
                    <article class="book__card">
                        <div class="book__img-wrapper">
                            <a href="{{ route('website.home.book-detail-view', $book->slug) }}">
                                <img src="{{ asset('storage/'. $book->images[0]->filename ) }}" alt="{{ $book->title }}" class="book__img">

                            </a>
                        </div>
                        <div class="book__info-wrapper">
                            <div class="quick__view-wrapper">
                                <div class="tooltip"><i class="fa-regular fa-eye" id="quickView" data-id="{{ $book->id }}"></i>
                                    <div class="top">
                                        <p>Quick View</p>
                                        <i></i>
                                    </div>
                                </div>
                                <div class="ratings-wrapper">
                                    <img src="{{ asset('assets/website/images/star.svg') }}" alt="">
                                    <img src="{{ asset('assets/website/images/star.svg') }}" alt="">
                                    <img src="{{ asset('assets/website/images/star.svg') }}" alt="">
                                    <img src="{{ asset('assets/website/images/star.svg') }}" alt="">
                                    <img src="{{ asset('assets/website/images/star.svg') }}" alt="">
                                </div>
                                <div class="tooltip"><i class="fa-regular fa-heart" id="addToWishList" data-id="{{ $book->id }}"></i>
                                    <div class="top">
                                        <p>Add To Wishlist</p>
                                        <i></i>
                                    </div>
                                </div>
                            </div>

                            <a class="book__name" href="{{ route('website.home.book-detail-view', $book->slug) }}">
                                {{$book->name}}
                            </a>

                            <div class="book__price">
                                <span class="book__real__price">
                                    Rs.{{ $book->price }}
                                </span>
                                <span class="book__special__price">Rs.{{ $book->special_price }}</span>
                            </div>
                            <button class="btn book__addtocart-btn" id="addToCartBtn" data-id="{{ $book->id }}">Add To Cart</button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>
    <!-- /Products Section -->

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/website') }}/js/main.js"></script>
@endpush
@endsection
