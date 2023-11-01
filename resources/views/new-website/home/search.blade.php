@extends('new-website.new-layouts.new-app')
@section('title', 'Search Product')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Search Product">
    <meta property="og:type" content="product.group">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Search Product">
    <meta name="twitter:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <link rel="canonical" href="{{ Request::url() }}">

@endsection

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home.index') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">contact us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Section Start -->
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-input-item d-flex" style="align-items: center;gap:20px">
                        <input type="text" class="navbar__search-input" id="mobilenavbar__search-input"
                            placeholder="What are you looking for">
                        <i class="lnr lnr-magnifier navbar__search-icon"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="search__books-wrapper" id="searchWrapper">
                        <!-- product single item start -->

                        <!-- product single item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End -->
@endsection
