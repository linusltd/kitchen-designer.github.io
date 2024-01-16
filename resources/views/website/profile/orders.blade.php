@extends('website.layouts.app')
@section('title', 'My Orders')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="My Orders">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="My Orders">
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
        <div class="profile__wrapper">
            @include('website.profile.navigation')
            <div class="profile__updateform profile__content" style="padding:0">
                <div class="order__table-wrapper">
                    <table class="order__table">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->orders as $item)
                            <tr>
                                <td data-label="Order No">#{{ $item->order_no }}</td>
                                <td data-label="Date">{{ \Carbon\Carbon::parse($item->received_at)->format('F j, Y') }}</td>
                                <td data-label="Status" id="orderStatus">
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
                                <td data-label="Total">{{ $item->total_amount }}</td>
                                <td data-label="Actions">
                                    <a href="{{ route('website.order.complete-order', $item->order_secret) }}" >
                                        <button class="btn orderbtn">
                                            View
                                        </button>
                                    </a>
                                    @if ($item->status == 0)
                                    <button class="btn orderbtn" id="orderCancelRequest" data-id="{{ $item->id }}">Cancel</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <!-- Add more table rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Profile Section -->
@include('website.profile.js.orders')
@endsection
