@extends('website.layouts.app')
@section('title', 'Your Shopping Cart')
@section('seo')
<meta property="og:site_name" content="Kitchen Designer">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="Your Shopping Cart">
<meta property="og:type" content="website">
<meta property="og:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Your Shopping Cart">
<meta name="twitter:description" content="Kitchen Designer is one of the largest online Kitchen Store in Pakistan. And Kitchen Designer first of its kind Products.">

<link rel="canonical" href="{{ Request::url() }}">

@endsection

@section('content')
<!-- Breadcrumb Section -->
<header class="breadcrumb">
    <div class="container breadcrumb__container">
        <a href="{{ route('website.home.index') }}" class="breadcrumb__link">Home</a>
        <a href="javascript:;">
            <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
        </a>
        <a href="" class="breadcrumb__link">Cart</a>
        <a href="javascript:;">
            <img src="{{ asset('assets/website') }}/images/chevron-right.svg" alt="">
        </a>
        <a href="" class="breadcrumb__link">Checkout & Order Complete</a>
    </div>
</header>
<!-- /Breadcrumb Section -->


@if (!is_null($cart))
<!-- Cart Items Section -->
<section class="cart">
    <div class="container cart__container">
        <table class="cart__table">
            <thead class="cart__thead">
                <tr>
                    <th align="left">Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="cart__body" id="cart__body">
                @foreach ($cart_items as $item)
                <tr>
                    <td>
                        <div class="cart__item">
                            <div class="cart__item-img">
                                <a href="{{ route('website.home.book-detail-view', $item->book->slug) }}" class="cart__item-name">
                                    <img src="{{ asset('storage/' . $item->book->images[0]->filename) }}" alt="{{ $item->book->name }}">
                                </a>
                            </div>
                            <div class="cart__item-info">
                                <a href="{{ route('website.home.book-detail-view', $item->book->slug) }}" class="cart__item-name">{{ $item->book->name }}
                                </a>
                                <span class="cart__mobile_quantity">{{ $item->quantity }} x Rs.{{ $item->price }} = Rs.{{ $item->total_price }}</span>
                                <i class="cart__mobile_trash fa fa-trash" style="cursor: pointer;color:red" id="deleteCartItem" data-id="{{ $item->id }}"></i>
                            </div>
                        </div>
                    </td>
                    <td>Rs.{{ $item->price }}</td>
                    <td><div class="quick__qty">
                        <div class="qty__wrapper">
                            <button class="minus__btn" id="removeFromCartInternalBtn" data-id="{{ $item->id }}"><i class="fas fa-minus"></i></button>
                            <input type="text" name="" id="" value="{{ $item->quantity }}" readonly>
                            <button class="plus__btn" id="addToCartInternalBtn" data-id="{{ $item->book_id }}"><i class="fas fa-plus"></i></button>
                        </div>
                    </div></td>
                    <td>Rs.{{ $item->total_price }}</td>
                    <td><i class="fa fa-trash" style="cursor: pointer;color:red" id="deleteCartItem" data-id="{{ $item->id }}"></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('website.home.shop') }}">
            <button class="btn continue__shopping">Continue Shopping</button>
        </a>
        {{-- <button class="btn buy_now-btn quick__btn" id="clearCart">Clear Cart</button> --}}
        <p class="returning__customer">Returning customer? <a href="">Click here to login</a></p>
    </div>
</section>
<!-- /Cart Items Section -->
<section class="billingshipping">
    <div class="container cart__container">
        <form action="" method="post" id="createOrderForm">
            @csrf
            <div class="cart__adress-wrapper">
                <div class="cart__shipping">
                    <h3 class="shipping__title">
                        BILLING & SHIPPING
                    </h3>
                    <div class="add__review-form">
                        <div class="form-group-inline">
                            <div class="form-group">
                                <label for="fname" class="lable">First Name <span style="color: red">*</span></label>
                                <input type="text" name="fname" class="form-control" value="{{ !is_null($address) ? $address->fname : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="lname" class="lable">Last Name <span style="color: red">*</span></label>
                                <input type="text" name="lname" class="form-control" value="{{ !is_null($address) ? $address->lname : '' }}">
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
                            <input type="text" name="address" class="form-control" value="{{ !is_null($address) ? $address->address : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="city" class="lable">Town/City <span style="color: red">*</span></label>
                            <input type="text" name="city" class="form-control" value="{{ !is_null($address) ? $address->city : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="state" class="lable">State <span style="color: red">*</span></label>
                            <select name="state" id="state" class="form-control">
                                <option value="">---select state---</option>
                                <option value="AZAD KASHMIR" @selected('AZAD KASHMIR' == !is_null($address) ? $address->state : '')>AZAD KASHMIR</option>
                                <option value="Balochistan" @selected('Balochistan' == !is_null($address) ? $address->state : '')>Balochistan</option>
                                <option value="FATA" @selected('FATA' == !is_null($address) ? $address->state : '')>FATA</option>
                                <option value="Gilgit Baltistan" @selected('Gilgit Baltistan' == !is_null($address) ? $address->state : '')>Gilgit Baltistan</option>
                                <option value="Islamabad Capital Territory" @selected('Islamabad Capital Territory' == !is_null($address) ? $address->state : '')>Islamabad Capital Territory</option>
                                <option value="Khyber Pakhtunkhwa" @selected('Khyber Pakhtunkhwa' == !is_null($address) ? $address->state : '')>Khyber Pakhtunkhwa</option>
                                <option value="Punjab" @selected('Punjab' == !is_null($address) ? $address->state : '')>Punjab</option>
                                <option value="Sindh" @selected('Sindh' == !is_null($address) ? $address->state : '')>Sindh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zip" class="lable">Postal Code / Zip <span style="color: red">*</span></label>
                            <input type="text" name="zip" class="form-control" value="{{ !is_null($address) ? $address->zip : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="lable">Phone <span style="color: red">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ !is_null($address) ? $address->phone : '' }}" oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div class="form-group">
                            <label for="email" class="lable">Email <span style="color: red">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ !is_null($address) ? $address->email : '' }}">
                        </div>

                        <div class="form-group">
                            <h3 class="additional__information">ADDITIONAL INFORMATION</h3>
                        </div>

                        <div class="form-group">
                            <label for="" class="lable">Order Notes (optional)</label>
                            <textarea name="note" id="note" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>
                </div>
                <div class="cart__ordersummary">
                    <h3 class="your__order">YOUR ORDER</h3>
                    <div class="ordersummary__table-wrapper">
                        <table class="ordersummary__table">
                            <thead>
                                <tr>
                                    <th align="left">PRODUCT</th>
                                    <th align="center">SUB TOTAL</th>
                                </tr>
                            </thead>
                            <tbody id="cartItemsBillBody">
                                @foreach ($cart_items as $item)
                                <tr>
                                    <td>{{ $item->book->name }} x {{ $item->quantity }}</td>
                                    <td align="center">Rs.{{ number_format($item->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td><strong>SUB TOTAL</strong></td>
                                    <td align="center">Rs.{{ number_format($cart->items_subtotal_price, 2) }}</td>
                                </tr>
                                @php $delivery_charges = $cart->items_subtotal_price <= 5000 ? 150 : 0; @endphp
                                <tr>
                                    <td><strong>SHIPPING FEE</strong></td>
                                    <td align="center" class="shipping__fee">Rs.{{$delivery_charges}}.00</td>
                                </tr>
                                <tr>
                                    <td class="total"><strong>TOTAL</strong></td>
                                    <td align="center" class="total">

                                        <strong>Rs.{{ number_format($cart->items_subtotal_price + $delivery_charges, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="payment__method">Payment Method</h3>
                    <div class="form-group checkbox-group">
                        <input type="radio" name="" id="" checked>
                        <label for="" class="lable"><b>Cash on delivery</b> (Pay with cash upon delivery.)</label>
                    </div>
                    <div style="margin: 30px">
                        <button class="btn continue__shopping place__order-btn" >Place Order</button>
                    </div>

                    <p style="color: #616161;font-size:12px">Your personal data will be used to process your order, support your experience
                        throughout this website, and for other purposes described in our privacy policy.</p>
                </div>
            </div>
        </form>
    </div>
</section>

@else
<section class="cart">
    <div class="container cart__container">
        <h2>Your Cart</h2>
        <br>
        <div style="display: flex;flex-direction:column;gap:1rem">
            <p>Your cart is currently empty</p>
            <p>Enable cookies to use the shopping cart</p>
            <p>Continue browsing <a style="text-decoration: underline;color:rgb(30, 30, 227)" href="{{ route('website.home.shop') }}">here</a>.</p>
        </div>
        <br>
    </div>
</section>
@endif


@include('website.cart.js.index')
@endsection
