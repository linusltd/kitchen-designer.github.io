@extends('website.layouts.app')
@section('title', 'Register')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Register">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Register">
    <meta name="twitter:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

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
            <a href="" class="breadcrumb__link">Create New Account</a>
        </div>
    </header>
    <!-- /Breadcrumb Section -->

    <!-- /Profile Section -->
    <section class="profile auth">
        <div class="container profile__container">
            <div class="profile__updateform profile__content">
                <h2 class="welcome__admin">Create A New Customer Account</h2>
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
                <form method="POST" action="{{ route('website.auth.submit-register-form') }}" class="add__review-form">
                    @csrf
                    <div class="form-group-inline">
                        <div class="form-group">
                            <input type="text" name="fname" placeholder="First Name" class="form-control"
                                value="{{ old('fname') }}" required />
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" placeholder="Last Name" class="form-control"
                                value="{{ old('lname') }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                            class="form-control" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                            class="form-control" required />
                    </div>
                    <div class="form-group">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="form-group form-groupbtn">
                        <button type="submit" class="btn auth__btn">Register</button>
                    </div>
                    <div class="form-group form-groupbtn">
                        <p class="register__alert">Already have an Account? <a href="{{ route('website.auth.login') }}"
                                style="  color: #0053A8;">Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <br><br>
    <!-- /Profile Section -->
@endsection
