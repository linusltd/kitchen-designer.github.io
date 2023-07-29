@extends('website.layouts.app')
@section('title', 'Customer Login')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Customer Login">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Customer Login">
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
        <a href="" class="breadcrumb__link">Login</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- /Profile Section -->
<section class="profile auth">
    <div class="container profile__container">
        <div class="profile__updateform profile__content">
            <h2 class="welcome__admin">Log In Your Account Here</h2>
            <div class="validation__errors">
                @error('fname')
                <span class="error">The First Name Field is Required.</span>
                @enderror
                @if (Session::has('message'))
                <span class="error">{{ Session::get('message') }}</span>
                @endif
                @error('lname')
                    <span class="error">{{ $message }}</span>
                @enderror
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
                @error('g-recaptcha-response')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <form method="POST" action="{{ route('website.auth.submit-login-form') }}" class="add__review-form">
                @csrf
                <input type="hidden" name="customer_type" value="0">
                <div class="form-group">
                    <label for="email" class="auth__label">Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        class="form-control"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="password" class="auth__label">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="********"
                        class="form-control"
                        required
                    />
                </div>
                <div class="form-group">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>
                <div class="form-group form-groupbtn">
                    <button type="submit" class="btn auth__btn">Login</button>
                    <a href="{{ route('website.auth.forgot-password') }}" class="forgot-password">forgot your password?</a>
                </div>
                <div class="form-group form-groupbtn">
                    <p class="register__alert">Not have an Account? <a href="{{ route('website.auth.register') }}" style="  color: #0053A8;">Create New</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
<br><br>
<!-- /Profile Section -->
@endsection
