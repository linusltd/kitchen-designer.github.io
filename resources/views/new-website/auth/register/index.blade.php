@extends('new-website.new-layouts.new-app')
@section('title', 'Customer Registration')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Customer Registration">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Customer Registration">
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
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">login/register</li>
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
                    <!-- Register Content Start -->
                    <div class="col-lg-6" style="margin:0 auto">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h2>Singup Form</h2>
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
                            <form action="{{ route('website.auth.submit-register-form') }}" method="post"
                                class="add__review-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="text" name="fname" placeholder="First Name"
                                                value="{{ old('fname') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="text" name="lname" placeholder="Last Name"
                                                value="{{ old('lname') }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                        required />
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" name="password" placeholder="Password" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm Password" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn__bg">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Register Content End -->
                </div>
            </div>
        </div>
    </div>
@endsection
