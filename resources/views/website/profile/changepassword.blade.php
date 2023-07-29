@extends('website.layouts.app')
@section('title', 'Customer Change Password')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Customer Change Password">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Customer Change Password">
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
            <div class="profile__updateform profile__content">
                <h2 class="welcome__admin">Change Password</h2>
                <form action="" class="add__review-form">
                    <div class="form-group">
                        <input type="password" placeholder="Old Password" class="form-control">
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <input type="password"
                            placeholder="New Password"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password"
                            placeholder="Confirm Password"
                             class="form-control">
                        </div>
                    </div>

                    <button class="btn book__addtocart-btn btn-submit">Update</button>

                </form>
            </div>
        </div>
    </div>
</section>
<!-- /Profile Section -->

@endsection
