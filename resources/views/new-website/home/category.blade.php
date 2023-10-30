@extends('new-website.new-layouts.new-app')
@section('title')
    {{ $category->name }}
@endsection
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="{{ $category->name }}">
    <meta property="og:type" content="product.group">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $category->name }}">
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
                                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
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
            <div class="row align-items-center" style="text-align:center;margin-bottom:30px">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    @php $categoriesList = getAllCategories(); @endphp
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h3 class="sidebar-title">categories</h3>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    @foreach ($categoriesList as $category)
                                        <li>
                                            <a href="{{ route('website.home.category-detail-view', $category->slug) }}">{{ $category->name }}
                                                <span>{{ $category->books->count() }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="{{ asset('new-assets/website/img/banner/sidebar-banner.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view"><i
                                                    class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view"><i class="fa fa-list"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            @foreach ($books as $book)
                                <div class="col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('website.home.book-detail-view', $book->slug) }}">
                                                <img class="pri-img"
                                                    src="{{ asset('storage/' . $book->images[0]->filename) }}"
                                                    alt="{{ $book->title }}">
                                                <img class="sec-img"
                                                    src="{{ asset('storage/' . $book->images[0]->filename) }}"
                                                    alt="{{ $book->title }}">
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
                                                <a href="" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    id="addToWishList" data-id="{{ $book->id }}"
                                                    title="Add to wishlist">
                                                    <i class="lnr lnr-heart"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                        data-bs-toggle="tooltip" data-id="{{ $book->id }}"
                                                        id="quickView" data-bs-placement="left" title="Quick View"><i
                                                            class="lnr lnr-magnifier"></i></span></a>
                                            </div>
                                            <div class="box-cart">
                                                <button type="button" class="btn btn-cart" data-id="{{ $book->id }}"
                                                    id="addToCartBtn">add to
                                                    cart</button>
                                            </div>
                                        </figure>
                                        <div class="product-caption">
                                            <div class="product-identity">
                                                <p class="manufacturer-name"><a
                                                        href="{{ route('website.home.book-detail-view', $book->slug) }}">mony</a>
                                                </p>
                                                <div class="ratings">
                                                    <span><i class="lnr lnr-star"></i></span>
                                                    <span><i class="lnr lnr-star"></i></span>
                                                    <span><i class="lnr lnr-star"></i></span>
                                                    <span><i class="lnr lnr-star"></i></span>
                                                    <span><i class="lnr lnr-star"></i></span>
                                                </div>
                                            </div>
                                            <p class="product-name">
                                                <a href="{{ route('website.home.book-detail-view', $book->slug) }}">
                                                    {{ $book->name }}</a>
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

                                    <!-- product list item end -->
                                    <div class="product-list-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('website.home.book-detail-view', $book->slug) }}">
                                                <img class="pri-img"
                                                    src="{{ asset('storage/' . $book->images[0]->filename) }}"
                                                    alt="{{ $book->title }}">
                                                <img class="sec-img"
                                                    src="{{ asset('storage/' . $book->images[0]->filename) }}"
                                                    alt="{{ $book->title }}">
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
                                                <a href="" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    id="addToWishList" data-id="{{ $book->id }}"
                                                    title="Add to wishlist">
                                                    <i class="lnr lnr-heart"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                        data-id="{{ $book->id }}" id="quickView"
                                                        data-bs-placement="left" title="Quick View"><i
                                                            class="lnr lnr-magnifier"></i></span></a>
                                            </div>
                                            <div class="box-cart">
                                                <button type="button" class="btn btn-cart">add to cart</button>
                                            </div>
                                        </figure>
                                        <div class="product-content-list">
                                            <div class="manufacturer-name">
                                                <a
                                                    href="{{ route('website.home.book-detail-view', $book->slug) }}">fresh</a>
                                            </div>
                                            <h5 class="product-name"><a
                                                    href="{{ route('website.home.book-detail-view', $book->slug) }}">{{ $book->name }}</a>
                                            </h5>
                                            <div class="ratings">
                                                <span><i class="lnr lnr-star"></i></span>
                                                <span><i class="lnr lnr-star"></i></span>
                                                <span><i class="lnr lnr-star"></i></span>
                                                <span><i class="lnr lnr-star"></i></span>
                                                <span><i class="lnr lnr-star"></i></span>
                                            </div>
                                            <div class="price-box">
                                                <span class="price-regular">Rs.{{ $book->special_price }}</span>
                                                @if ($book->price !== $book->special_price)
                                                    <span class="price-old"><del>Rs.{{ $book->price }}</del></span>
                                                @endif
                                            </div>
                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde
                                                perspiciatis
                                                quod numquam, sit fugiat, deserunt ipsa mollitia sunt quam corporis
                                                ullam
                                                rem, accusantium adipisci officia eaque.</p>
                                        </div>
                                    </div>
                                    <!-- product list item end -->
                                </div>
                            @endforeach

                        </div>
                        <!-- product item list wrapper end -->

                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li class="{{ $books->onFirstPage() ? ' disabled' : '' }}">
                                    <a class="previous" href="{{ $books->previousPageUrl() }}">
                                        <i class="lnr lnr-chevron-left"></i>
                                    </a>
                                </li>

                                @for ($i = 1; $i <= $books->lastPage(); $i++)
                                    <li class="{{ $books->currentPage() == $i ? '' : '' }}">
                                        <a class="active" href="{{ $books->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li class="{{ $books->hasMorePages() ? '' : ' disabled' }}">
                                    <a class="next" href="{{ $books->nextPageUrl() }}">
                                        <i class="lnr lnr-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
    </div>
@endsection
