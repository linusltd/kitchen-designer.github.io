@extends('website.layouts.app')
@section('title', 'Customer Update Addresses')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Customer Update Addresses">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Customer Update Addresses">
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
                    <h2 class="welcome__admin">Address Details</h2>
                    <form action="" method="post" class="add__review-form" id="createOrderForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ !is_null($address) ? $address->id : '' }}">
                        <div class="form-group-inline">
                            <div class="form-group">
                                <label for="fname" class="lable">First Name <span style="color: red">*</span></label>
                                <input type="text" name="fname" class="form-control"
                                    value="{{ !is_null($address) ? $address->fname : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="lname" class="lable">Last Name <span style="color: red">*</span></label>
                                <input type="text" name="lname" class="form-control"
                                    value="{{ !is_null($address) ? $address->lname : '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="lable">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="Pakistan">Pakistan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address" class="lable">Address <span style="color: red">*</span></label>
                            <input type="text" name="address" class="form-control"
                                value="{{ !is_null($address) ? $address->address : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="city" class="lable">Town/City <span style="color: red">*</span></label>
                            <input type="text" name="city" class="form-control"
                                value="{{ !is_null($address) ? $address->city : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="state" class="lable">State <span style="color: red">*</span></label>
                            <select name="state" id="state" class="form-control">
                                <option value="AZAD KASHMIR" @selected('AZAD KASHMIR' == !is_null($address) ? $address->state : '')>AZAD KASHMIR</option>
                                <option value="Balochistan" @selected('Balochistan' == !is_null($address) ? $address->state : '')>Balochistan</option>
                                <option value="FATA" @selected('FATA' == !is_null($address) ? $address->state : '')>FATA</option>
                                <option value="Gilgit Baltistan" @selected('Gilgit Baltistan' == !is_null($address) ? $address->state : '')>Gilgit Baltistan</option>
                                <option value="Islamabad Capital Territory" @selected('Islamabad Capital Territory' == !is_null($address) ? $address->state : '')>Islamabad Capital
                                    Territory</option>
                                <option value="Khyber Pakhtunkhwa" @selected('Khyber Pakhtunkhwa' == !is_null($address) ? $address->state : '')>Khyber Pakhtunkhwa</option>
                                <option value="Punjab" @selected('Punjab' == !is_null($address) ? $address->state : '')>Punjab</option>
                                <option value="Sindh" @selected('Sindh' == !is_null($address) ? $address->state : '')>Sindh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zip" class="lable">Postal Code / Zip <span style="color: red">*</span></label>
                            <input type="text" name="zip" class="form-control"
                                value="{{ !is_null($address) ? $address->zip : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="lable">Phone <span style="color: red">*</span></label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ !is_null($address) ? $address->phone : '' }}"
                                oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div class="form-group">
                            <label for="email" class="lable">Email <span style="color: red">*</span></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ !is_null($address) ? $address->email : '' }}">
                        </div>
                        <button type="submit" class="btn auth__btn">Update Address</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /Profile Section -->
    @include('website.profile.js.updateadress')
@endsection
