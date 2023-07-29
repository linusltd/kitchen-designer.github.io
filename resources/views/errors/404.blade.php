@extends('website.layouts.app')
@section('title', '404 - Not Found')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="404 - Not Found">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="404 - Not Found">
<meta name="twitter:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<link rel="canonical" href="{{ Request::url() }}">
@endsection

@section('content')
<!-- Breadcrumb Section -->
<header class="breadcrumb">
    <div class="container breadcrumb__container">
        <a href="{{ route('website.home.index') }}" class="breadcrumb__link">Home</a>
        <a href="javascript:;">
            <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
        </a>
        <a href="" class="breadcrumb__link">My Account</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- 404 Not Found -->
<section>
    <div class="container">
        <div class="notfound__container">
            <div class="left__container">
                <div class="notfound__img-wrapper">
                    <img src="{{ asset('assets/website/images/404.jpg') }}" alt="404 Image"/>
                </div>
            </div>
            <div class="right__container">
                <h1 class="notfound__title">OOPS! PAGE NOT FOUND</h1>
                <p>Sorry, but the page you are looking for is not found.</p>
                <a href="{{ route('website.home.index') }}" class="notfound__btn notfound__btn-lg">Return To Home</a>
            </div>
        </div>
    </div>
</section>
<!-- /404 Not Found -->


@include('website.cart.js.index')
@endsection
