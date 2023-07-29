@extends('website.layouts.app')
@section('title', 'Customer Profile')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Customer Profile">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Customer Profile">
<meta name="twitter:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<link rel="canonical" href="{{ Request::url() }}">
@endsection

@section('content')
<!-- Breadcrumb Section -->
<header class="breadcrumb profile-breadcrumb">
    <div class="container breadcrumb__container">
        <a href="{{ route('website.home.index') }}" class="breadcrumb__link">Home</a>
        <a href="javascript:;">
            <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
        </a>
        <a href="" class="breadcrumb__link">Profile</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- /Profile Section -->
<section class="profile">
    <div class="container profile__container">
        <h1 class="profile__title">My Account</h1>
        <div class="profile__wrapper">
            @include('website.profile.navigation')

            <div class="profile__statics profile__content">
                <h2 class="welcome__admin">Welcome Admin</h2>
                <div class="statics__wrapper">
                    <article class="startics__item">
                        <div class="startics__item-img">
                            <img src="{{ asset('assets/website/images/totalorder.svg') }}" alt="">
                            <span class="startics__item-span">{{ $totalOrders }}</span>
                        </div>
                        <p class="total__order">Total Order</p>
                    </article>
                    <article class="startics__item">
                        <div class="startics__item-img">
                            <img src="{{ asset('assets/website/images/pendingorder.svg') }}" alt="">
                            <span class="startics__item-span">{{ $pendingOrders }}</span>
                        </div>
                        <p class="total__order">Pending Order</p>
                    </article>
                    <article class="startics__item">
                        <div class="startics__item-img">
                            <img src="{{ asset('assets/website/images/processingorder.svg') }}" alt="">
                            <span class="startics__item-span">{{ $shippedOrders }}</span>
                        </div>
                        <p class="total__order">Processing Order</p>
                    </article>
                    <article class="startics__item">
                        <div class="startics__item-img">
                            <img src="{{ asset('assets/website/images/deliveredorder.svg') }}" alt="">
                            <span class="startics__item-span">{{ $deliveredOrders }}</span>
                        </div>
                        <p class="total__order">Delivered Order</p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Profile Section -->

@endsection
