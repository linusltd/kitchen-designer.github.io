@extends('website.layouts.app')
@section('title', 'Forgot Password')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Forgot Password">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Forgot Password">
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
        <a href="" class="breadcrumb__link">Forgot Password</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- /Profile Section -->
<section class="profile auth">
    <div class="container profile__container">
        <div class="profile__updateform profile__content">
            <h2 class="welcome__admin">FORGOT YOUR PASSWORD?</h2>
            <p class="reset__link">Please enter your email address below to receive a password reset link.</p>
            <div class="validation__errors">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if (Session::has('message'))
                <span class="error">{{ Session::get('message') }}</span>
                @endif
            </div>
            <form action="{{ route('website.auth.forgot-password-process') }}" method="post" class="add__review-form">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="form-group form-groupbtn">
                    <button type="submit" class="btn auth__btn">Reset Password</button>
                </div>
                <div class="form-group form-groupbtn">
                    <p class="register__alert"><a href="{{ route('website.auth.login') }}" style="  color: #0053A8;">Login</a> - <a href="{{ route('website.auth.register') }}" style="  color: #0053A8;">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- /Profile Section -->

@endsection
