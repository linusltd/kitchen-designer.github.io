@extends('new-website.new-layouts.new-app')
@section('title', 'Customer Forgot Password')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Customer Forgot Password">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Customer Login">
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
                            <h1>Forgot Password</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('website.home.index') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-space">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-6" style="margin: 0 auto">
                        <div class="login-reg-form-wrap">
                            <h2>Forgot your Password?</h2>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            @if (Session::has('message'))
                                <span class="error">{{ Session::get('message') }}</span>
                            @endif
                            <form action="{{ route('website.auth.forgot-password-process') }}" method="post"
                                id="add__review-form">
                                @csrf
                                <div class="single-input-item">
                                    <input type="email"name="email" placeholder="Email" value="{{ old('email') }}"
                                        required />
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn__bg">Send Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->
                </div>
            </div>
        </div>
    </div>
@endsection
