@extends('website.layouts.app')
@section('title', 'Search Book')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Search Book">
<meta property="og:type" content="product.group">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Search Book">
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
        <a href="" class="breadcrumb__link">Search Book</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- /Search Book Section -->
<section class="search__page">
        <div class="container">
        <!-- Seacrh Input -->
        <div class="navbar__search-wrapper">
            <input type="text" class="navbar__search-input" id="mobilenavbar__search-input"
            placeholder="What are you looking for"
            />
            <img src="{{ asset('assets/website/images/search-icon.svg') }}" alt="Magnifier" class="navbar__search-icon">

        </div>
        <!-- /Seacrh Input -->

        <div class="" style="margin-top:20px">
            <div class="search__books-wrapper" id="mobilebookSearchWrapper">

            </div>
        </div>
    </div>
</section>
<!-- /Search Book Section -->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/website') }}/js/main.js"></script>
@endpush
@endsection
