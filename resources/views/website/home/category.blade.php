@extends('website.layouts.app')
@section('title')
{{ $category->name }}
@endsection
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="{{ $category->name }}">
<meta property="og:type" content="product.group">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $category->name }}">
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
        <a href="" class="breadcrumb__link">{{ $category->name }}</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- Products Section -->
<section class="bookcategory">
    <div class="container bookcategory__container">
        @include('website.utils.categories-list')
        <div class="bookcategory__category-section">
            <!-- Banner Section -->
            <header class="banner__header shop__header">
                <div class="banner__wrapper">
                    <div class="banner__item">
                        @foreach ($sliders as $slider)
                        <div class="header__img-wrapper slides fade">
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
            <!-- /Banner Section -->
            <div class="">
                <h1 class="books__category-title shop__category-title">{{ $category->name }}</h1>
                @include('website.home.booklist')
            </div>
        </div>
    </div>
</section>
<!-- /Products Section -->
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/website') }}/js/main.js"></script>
@endpush
@endsection
