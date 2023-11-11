@extends('new-website.new-layouts.new-app')
@section('title', 'Order Complete')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Order Complete">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Order Complete">
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
                                <li class="breadcrumb-item active" aria-current="page">Order Complete</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="order-main-wrapper section-space ">
        <div class="container">
            <div class="section-bg-color">
                <div class="order__header">
                    <div class="complete__img-wrapper">
                        <img src="{{ asset('assets/website/images/tick.png') }}" alt="Tick Image" class="complete__img">
                    </div>
                    <div class="order__no-wrapper">
                        <span class="order__no">Order No #{{ $order->order_no }} </span>
                        <h3 class="thank__you">Thank You {{ $order->address->fname }}!</h3>
                    </div>
                </div>
                <div class="order__wrapper">
                    <div class="order__info-wrapper">
                        <div class="order__basic">
                            <div class="order__confirmed">
                                <h3 class="order__basic-title">Your Order Is Conformed</h3>
                                <p class="order__basic-info">
                                    Payment method is cash on delivery
                                </p>
                            </div>
                            <div class="order__confirmed">
                                <h3 class="order__basic-title">Our Updates </h3>
                                <p class="order__basic-info">
                                    You’ll get shipping and delivery updates by email.
                                </p>
                            </div>
                        </div>
                        <div class="custom__info">
                            <div class="info__header">
                                <h1>Customer information</h1>
                            </div>
                            <div class="info__body">
                                <div class="custom__contact">
                                    <h3 class="custom__contact-title">Contact information</h3>
                                    <p class="custom__contact-info">{{ $order->address->email }}</p>
                                </div>
                                <div class="custom__contact">
                                    <h3 class="custom__contact-title">Payment method</h3>
                                    <p class="custom__contact-info">Cash on delivery (COD) - <strong
                                            class="deliver__charges">Rs.{{ number_format($order->total_amount) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="info__body">
                                <div class="custom__contact">
                                    <h3 class="custom__contact-title">Shipping Address</h3>
                                    <p class="custom__contact-info">
                                        {{ $order->address->fname . ' ' . $order->address->lname }}</p>
                                    <p class="custom__contact-info">{{ $order->address->address }}</p>
                                    <p class="custom__contact-info">
                                        {{ $order->address->city . ' ' . $order->address->zip }}
                                    </p>
                                    <p class="custom__contact-info">Pakistan</p>
                                    <p class="custom__contact-info ">{{ $order->address->phone }}</p>
                                </div>
                                <div class="custom__contact">
                                    <h3 class="custom__contact-title">Billing Address</h3>
                                    <p class="custom__contact-info">
                                        {{ $order->address->fname . ' ' . $order->address->lname }}</p>
                                    <p class="custom__contact-info">{{ $order->address->address }}</p>
                                    <p class="custom__contact-info">
                                        {{ $order->address->city . ' ' . $order->address->zip }}
                                    </p>
                                    <p class="custom__contact-info">Pakistan</p>
                                    <p class="custom__contact-info ">{{ $order->address->phone }}</p>
                                </div>
                            </div>
                            <div class="info__body">
                                <div class="custom__contact">
                                    <h3 class="custom__contact-title">Shipping method</h3>
                                    <p class="custom__contact-info">Delivery Charges</p>
                                </div>
                            </div>

                        </div>
                        <div class="need__help">
                            <p class="returning__customer">Need Help? <a href="{{ route('website.home.contact') }}">Contact
                                    Us</a>
                            </p>
                            <div>
                                <a href="{{ route('website.home.shop') }}">
                                    <button class="btn buy_now-btn quick__btn">Continue Shopping</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order__summary">
                        <table class="cart__table">
                            <thead class="cart__thead">
                                <tr>
                                    <th align="left">Product</th>
                                    <th></th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody class="cart__body">
                                @foreach ($order->order_items as $item)
                                    <tr>
                                        <td>
                                            <div class="cart__item">
                                                <div class="cart__item-img">
                                                    <a
                                                        href="{{ route('website.home.book-detail-view', $item->book->slug) }}">
                                                        <img src="{{ asset('storage/' . $item->book->images[0]->filename) }}"
                                                            alt="{{ $item->book->name }}">
                                                    </a>
                                                </div>
                                                <a href="{{ route('website.home.book-detail-view', $item->book->slug) }}">
                                                    <p class="cart__item-name">{{ $item->book->name }}</p>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ intval($item->qty) }}x</td>
                                        <td>Rs.{{ $item->price }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>SUB TOTAL</strong></td>
                                        <td></td>
                                        <td align="center">Rs.{{ number_format($order->sub_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>SHIPPING FEE</strong></td>
                                        <td></td>
                                        <td align="center" class="shipping__fee">
                                            Rs.{{ number_format($order->delivery_charges) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="total"><strong>TOTAL</strong></td>
                                        <td></td>
                                        <td align="center" class="total">
                                            <strong>Rs.{{ number_format($order->total_amount) }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- @include('new-website.cart.js.index') --}}
    @include('new-website.cart.js.index')

@endsection
