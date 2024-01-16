@extends('new-website.new-layouts.new-app')
@section('title', 'Customer Profile')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Customer Profile">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Customer Profile">
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
                                <li class="breadcrumb-item"><a href="{{ route('website.home.index') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('website.home.shop') }}">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">my account</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-space">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-bs-toggle="tab"><i
                                                class="fa fa-dashboard"></i>
                                            Dashboard</a>
                                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                            Orders</a>
                                        <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                            Details</a>
                                        <a href="#changepassword" data-bs-toggle="tab"><i class="fa fa-user"></i> Change
                                            Password</a>
                                        <a href="{{ route('website.auth.logout') }}"><i class="fa fa-sign-out"></i>
                                            Logout</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="statics__wrapper">
                                                    <article class="startics__item">
                                                        <div class="startics__item-img">
                                                            <img src="{{ asset('assets/website/images/totalorder.svg') }}"
                                                                alt="">
                                                            <span class="startics__item-span">{{ $totalOrders }}</span>
                                                        </div>
                                                        <p class="total__order">Total Order</p>
                                                    </article>
                                                    <article class="startics__item">
                                                        <div class="startics__item-img">
                                                            <img src="{{ asset('assets/website/images/pendingorder.svg') }}"
                                                                alt="">
                                                            <span class="startics__item-span">{{ $pendingOrders }}</span>
                                                        </div>
                                                        <p class="total__order">Pending Order</p>
                                                    </article>
                                                    <article class="startics__item">
                                                        <div class="startics__item-img">
                                                            <img src="{{ asset('assets/website/images/processingorder.svg') }}"
                                                                alt="">
                                                            <span class="startics__item-span">{{ $shippedOrders }}</span>
                                                        </div>
                                                        <p class="total__order">Processing Order</p>
                                                    </article>
                                                    <article class="startics__item">
                                                        <div class="startics__item-img">
                                                            <img src="{{ asset('assets/website/images/deliveredorder.svg') }}"
                                                                alt="">
                                                            <span class="startics__item-span">{{ $deliveredOrders }}</span>
                                                        </div>
                                                        <p class="total__order">Delivered Order</p>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user->orders as $item)
                                                                <tr>
                                                                    <td>#{{ $item->order_no }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($item->received_at)->format('F j, Y') }}
                                                                    </td>
                                                                    <td id="orderStatus">
                                                                        @if ($item->status == 0)
                                                                            Pending
                                                                        @elseif ($item->status == 1)
                                                                            Delivered
                                                                        @elseif ($item->status == 3)
                                                                            Shipped
                                                                        @elseif ($item->status == 2)
                                                                            Cancelled
                                                                        @elseif ($item->status == 4)
                                                                            Cancel Request
                                                                        @elseif ($item->status == 5)
                                                                            Failed Delivery
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $item->total_amount }}</td>
                                                                    <td>
                                                                        <a href="{{ route('website.order.complete-order', $item->order_secret) }}"
                                                                            class="btn btn__bg">View</a>
                                                                        @if ($item->status == 0)
                                                                            <button class="btn orderbtn"
                                                                                id="orderCancelRequest"
                                                                                data-id="{{ $item->id }}">Cancel</button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    <form id="createOrderForm" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ !is_null($address) ? $address->id : '' }}">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">First
                                                                        Name</label>
                                                                    <input type="text" id="first-name"
                                                                        placeholder="First Name" name="fname"
                                                                        value="{{ !is_null($address) ? $address->fname : '' }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">Last
                                                                        Name</label>
                                                                    <input type="text" id="last-name"
                                                                        placeholder="Last Name" name="lname"
                                                                        value="{{ !is_null($address) ? $address->lname : '' }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="country" class="required">Country</label>
                                                            <select name="country" id="country">
                                                                <option value="Pakistan">Pakistan</option>
                                                            </select>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required"
                                                                style="margin-top:10px">Email Address</label>
                                                            <input type="email" id="email"
                                                                placeholder="Email Address" name="email"
                                                                value="{{ !is_null($address) ? $address->email : '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="address" class="required"
                                                                style="margin-top:10px">Address</label>
                                                            <input type="text" id="address" placeholder="Address"
                                                                name="address"
                                                                value="{{ !is_null($address) ? $address->address : '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="city" class="required">Town/City</label>
                                                            <input type="text" name="city"
                                                                value="{{ !is_null($address) ? $address->city : '' }}">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="state" class="required">State</label>
                                                            <select name="state" id="state">
                                                                <option value="AZAD KASHMIR" @selected('AZAD KASHMIR' == !is_null($address) ? $address->state : '')>
                                                                    AZAD KASHMIR</option>
                                                                <option value="Balochistan" @selected('Balochistan' == !is_null($address) ? $address->state : '')>
                                                                    Balochistan</option>
                                                                <option value="FATA" @selected('FATA' == !is_null($address) ? $address->state : '')>FATA
                                                                </option>
                                                                <option value="Gilgit Baltistan"
                                                                    @selected('Gilgit Baltistan' == !is_null($address) ? $address->state : '')>Gilgit Baltistan</option>
                                                                <option value="Islamabad Capital Territory"
                                                                    @selected('Islamabad Capital Territory' == !is_null($address) ? $address->state : '')>Islamabad Capital
                                                                    Territory</option>
                                                                <option value="Khyber Pakhtunkhwa"
                                                                    @selected('Khyber Pakhtunkhwa' == !is_null($address) ? $address->state : '')>Khyber Pakhtunkhwa</option>
                                                                <option value="Punjab" @selected('Punjab' == !is_null($address) ? $address->state : '')>Punjab
                                                                </option>
                                                                <option value="Sindh" @selected('Sindh' == !is_null($address) ? $address->state : '')>Sindh
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button type="submit" class="btn btn__bg place__order-btn"
                                                                style="margin-top:20px">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="changepassword" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Change Password</h3>
                                                <div class="account-details-form">
                                                    <form method="post">
                                                        <input type="hidden" name="id"
                                                            value="{{ !is_null($address) ? $address->id : '' }}">
                                                        <div class="single-input-item">
                                                            <label for="email" class="required"
                                                                style="margin-top:10px">Old Password</label>
                                                            <input type="password" placeholder="Old Password"
                                                                class="form-control">
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="email" class="required"
                                                                style="margin-top:10px">Password</label>
                                                            <input type="password" id="password" placeholder="Password"
                                                                name="address"
                                                                value="{{ !is_null($address) ? $address->address : '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="city" class="required">Confirm
                                                                Password</label>
                                                            <input type="password" name="passwordconfirmation"
                                                                placeholder="Confirm Password"
                                                                value="{{ !is_null($address) ? $address->city : '' }}">
                                                        </div>

                                                        <div class="single-input-item">
                                                            <button class="btn btn__bg" style="margin-top:20px">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('new-website.profile.js.updateaddress')
    @include('new-website.profile.js.orders')

@endsection
