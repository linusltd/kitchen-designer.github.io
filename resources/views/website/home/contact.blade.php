@extends('website.layouts.app')
@section('title', 'Contact Us')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Contact Us">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Contact Us">
<meta name="twitter:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<link rel="canonical" href="{{ Request::url() }}">
<meta name="description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

@endsection

@section('content')
@php
    $general = getGeneral();
@endphp
<!-- Breadcrumb Section -->
<header class="breadcrumb">
    <div class="container breadcrumb__container">
        <a href="{{ route('website.home.index') }}" class="breadcrumb__link">Home</a>
        <a href="javascript:;">
            <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
        </a>
        <a href="" class="breadcrumb__link">Contact Us</a>
    </div>
</header>
<!-- /Breadcrumb Section -->

<!-- Contact Us Found -->
<section>
    <div class="container">
        <div class="contact__container contactus__container">
            <div class="left__container">
                <div class="contact__info-container">

                    {{-- Location --}}
                    <div class="contact__info">
                        <div class="contact__info-img">
                            <img src="{{ asset('assets/website/images/clocation.svg') }}" alt="Location Icon" />
                        </div>
                        <div class="contact__info-content">
                            <h3>Head Office</h3>
                            <p>
                                {{ $general->address }}
                            </p>
                        </div>
                    </div>
                    {{-- /Location --}}

                    {{-- Location --}}
                    <div class="contact__info">
                        <div class="contact__info-img">
                            <img src="{{ asset('assets/website/images/clocation.svg') }}" alt="Location Icon" />
                        </div>
                        <div class="contact__info-content">
                            <h3>Ware House</h3>
                            <p>
                                {{ $general->warehouse_address }}
                            </p>
                        </div>
                    </div>
                    {{-- /Location --}}

                    {{-- Email --}}
                    <div class="contact__info">
                        <div class="contact__info-img">
                            <img src="{{ asset('assets/website/images/cemail.svg') }}" alt="Email Icon" />
                        </div>
                        <div class="contact__info-content">
                            <h3>Email</h3>
                            <p>
                                {{ $general->email }}
                            </p>
                        </div>
                    </div>
                    {{-- /Email --}}

                    {{-- Office Time --}}
                    <div class="contact__info">
                        <div class="contact__info-img">
                            <img src="{{ asset('assets/website/images/ctime.svg') }}" alt="Office Time Icon" />
                        </div>
                        <div class="contact__info-content">
                            <h3>Open Time</h3>
                            <p>
                                {{ $general->office_timing }}
                            </p>
                        </div>
                    </div>
                    {{-- /Office Time --}}

                    {{-- Phone Number --}}
                    <div class="contact__info">
                        <div class="contact__info-img">
                            <img src="{{ asset('assets/website/images/cphone.svg') }}" alt="Phone Number Icon" />
                        </div>
                        <div class="contact__info-content">
                            <h3>Phone Number</h3>
                            <p>
                                {{ $general->phone }}
                            </p>
                        </div>
                    </div>
                    {{-- /Phone Number --}}

                </div>
            </div>
            <div class="right__container contanct__form">
                <div class="validation__errors">

                    @if (Session::has('message'))
                    <span>{{ Session::get('message') }}</span>
                    @endif

                    @error('email')
                        <span class="error">Email is invalid.</span>
                    @enderror
                </div>
                <form method="post" action="{{ route('website.home.contact-post') }}" class="mycontact__form">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name"/>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number"/>
                    </div>
                    <div class="form-group">
                        <label for="">Comment</label>
                        <textarea name="query" id="query" cols="30" rows="5" placeholder="Write your comment here.....">{{old('query')}}</textarea>
                    </div>
                    <div class="form-group form-groupbtn">
                        <button type="submit" class="btn auth__btn">SEND MESSAGE</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
<br><br> <br><br>

    <div class="mapouter"><div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13510.851006844618!2d74.13035305248859!3d32.15804952329179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391f2bdfa4b9e017%3A0xa28d3e96d499894d!2sHaider%20Colony%20Kotli%20Rustam%2C%20Gujranwala%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1691706121479!5m2!1sen!2s" width="100" height="450" style="border:0;width:100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>

</section>
<!-- /Contact Us Found -->

@include('website.cart.js.index')
@endsection


