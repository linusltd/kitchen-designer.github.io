@extends('new-website.new-layouts.new-app')
@section('title', 'Your Shopping Cart')
@section('seo')
    <meta property="og:site_name" content="Kitchen Designer">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="Your Shopping Cart">
    <meta property="og:type" content="website">
    <meta property="og:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Shopping Cart">
    <meta name="twitter:description"
        content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

    <link rel="canonical" href="{{ Request::url() }}">

@endsection

@section('content')
    <!-- breadcrumb area start -->
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
                                <li class="breadcrumb-item active" aria-current="page">checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-space">
        <div class="container">
            <form id="createOrderForm" method="post">
                @csrf
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h2>Billing Details</h2>
                            <div class="billing-form-wrap">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="fname" class="required">First Name</label>
                                            <input type="text" name="fname" id="fname" placeholder="First Name"
                                                value="{{ !is_null($address) ? $address->fname : '' }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="lname" class="required">Last Name</label>
                                            <input type="text" name="lname" id="lname" placeholder="Last Name"
                                                value="{{ !is_null($address) ? $address->lname : '' }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="Email Address"
                                        value="{{ !is_null($address) ? $address->email : '' }}" />
                                </div>

                                <div class="single-input-item">
                                    <label for="country" class="required">Country</label>
                                    <select name="country" id="country">
                                        <option value="Pakistan">Pakistan</option>
                                    </select>
                                </div>

                                <div class="single-input-item">
                                    <label for="street-address" class="required mt-20">Street address</label>
                                    <input type="text" name="address" id="street-address" placeholder="Street address"
                                        value="{{ !is_null($address) ? $address->address : '' }}" />
                                </div>

                                <div class="single-input-item">
                                    <label for="town" class="required">Town / City</label>
                                    <input type="text" name="city" id="town" placeholder="Town / City"
                                        value="{{ !is_null($address) ? $address->city : '' }}" />
                                </div>

                                <div class="single-input-item">
                                    <label for="state" class="required">State</label>
                                    <select name="state" id="state">
                                        <option value="">---select state---</option>
                                        <option value="AZAD KASHMIR" @selected('AZAD KASHMIR' == !is_null($address) ? $address->state : '')>AZAD KASHMIR</option>
                                        <option value="Balochistan" @selected('Balochistan' == !is_null($address) ? $address->state : '')>Balochistan</option>
                                        <option value="FATA" @selected('FATA' == !is_null($address) ? $address->state : '')>FATA</option>
                                        <option value="Gilgit Baltistan" @selected('Gilgit Baltistan' == !is_null($address) ? $address->state : '')>Gilgit Baltistan
                                        </option>
                                        <option value="Islamabad Capital Territory" @selected('Islamabad Capital Territory' == !is_null($address) ? $address->state : '')>Islamabad
                                            Capital Territory</option>
                                        <option value="Khyber Pakhtunkhwa" @selected('Khyber Pakhtunkhwa' == !is_null($address) ? $address->state : '')>Khyber Pakhtunkhwa
                                        </option>
                                        <option value="Punjab" @selected('Punjab' == !is_null($address) ? $address->state : '')>Punjab</option>
                                        <option value="Sindh" @selected('Sindh' == !is_null($address) ? $address->state : '')>Sindh</option>
                                    </select>
                                </div>

                                <div class="single-input-item">
                                    <label for="postcode" class="required">Postcode / ZIP</label>
                                    <input type="text" name="zip" id="postcode" placeholder="Postcode / ZIP"
                                        value="{{ !is_null($address) ? $address->zip : '' }}" />
                                </div>

                                <div class="single-input-item">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone"
                                        value="{{ !is_null($address) ? $address->phone : '' }}" placeholder="Phone"
                                        oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                </div>

                                <div class="single-input-item">
                                    <label for="note">Order Note</label>
                                    <textarea name="note" id="note" cols="30" rows="10"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>

            <!-- Order Summary Details -->
            <div class="col-lg-6">
                <div class="order-summary-details">
                    <h2>Your Order Summary</h2>
                    <div class="order-summary-content">
                        <!-- Order Summary Table -->
                        <div class="order-summary-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart_items as $item)
                                        <tr>
                                            <td>
                                                <p style="width: 100%;text-wrap:wrap;">
                                                    {{ $item->book->name }} <strong> ×
                                                        {{ $item->quantity }}</strong></p>
                                            </td>
                                            <td>Rs.{{ number_format($item->total_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td><strong>Rs.{{ number_format($cart->items_subtotal_price, 2) }}</strong>
                                        </td>
                                    </tr>
                                    @php $delivery_charges = $cart->items_subtotal_price <= 10000 ? 300: 0; @endphp
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="d-flex justify-content-center">
                                            Rs.{{ $delivery_charges }}.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>Rs.{{ number_format($cart->items_subtotal_price + $delivery_charges, 2) }}</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Order Payment Method -->
                        <div class="order-payment-method">
                            <div class="single-payment-method show">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cashon" name="paymentmethod" value="cash"
                                            class="custom-control-input" checked />
                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="cash">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>

                            <div class="summary-footer-area">
                                <div class="custom-control custom-checkbox mb-20">
                                    <input type="checkbox" class="custom-control-input" id="terms" required />
                                    <label class="custom-control-label" for="terms">I have read and agree to
                                        the website <a href="#">terms and conditions.</a></label>
                                </div>
                                <button type="submit" class="btn btn__bg place__order-btn" id="place__order-btn">Place
                                    Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- checkout main wrapper end -->
    @include('new-website.cart.js.index')
@endsection
