@extends('emails.layout')
@section('content')
    <div class="orderid__details">
        <p>[Order #{{ $details['details']['order']['order_no'] }}]</p>
        <p>({{ $details['details']['date'] }})</p>
    </div>

    <!-- Purchase -->

    <p class="thankforpurchase">Thank you for your purchase</p>
    <br>
    <!-- Order Reminder -->

    <p class="orderreminder">
        Thanks for your order. It’s on-hold until we confirm that payment has
        been received. In the meantime, here’s a reminder of what you ordered:
    </p>

    <!-- Buttons -->
    <div class="buttons">
        <a href="{{ route('website.order.complete-order', $details['details']['order']['order_secret']) }}"
            class="btn btn__vieworder">View Order</a>
        <span>Or</span>
        <a href="{{ route('website.home.index') }}" class="btn btn__visitourstore">Visit our store</a>
    </div>

    <!-- Order Summary Section -->
    <div class="order__summary">
        <p class="ordersummary">Order Summary</p>
        <div class="summary__block">
            @foreach ($details['details']['orderItems'] as $item)
                <div class="summary">
                    <div class="summary__details">
                        <a href="{{ route('website.home.book-detail-view', $item['book']['slug']) }}"><img
                                src="{{ asset('storage/' . $item['book']['images'][0]['filename']) }}"
                                alt="{{ $item['book']['name'] }}" width="300" height="200" /></a>
                        <a href="{{ route('website.home.book-detail-view', $item['book']['slug']) }}">
                            <p class="product__name">{{ $item['book']['name'] }}</p>
                        </a>
                        <p class="product__quantity">{{ intval($item['qty']) }} x {{ intval($item['price']) }}</p>
                    </div>

                    <p class="product__price">Rs.{{ $item['total_amount'] }}</p>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Total Price -->

    <div class="total__price">
        <table>
            <tr>
                <td class="subtotal">Sub Total</td>
                <td class="subtotal__value">Rs.{{ $details['details']['order']['sub_total'] }}</td>
            </tr>
            <tr>
                <td class="shippingcharges">Shipping Charges</td>
                <td class="shippingcharges__value">Rs.{{ $details['details']['order']['delivery_charges'] }}</td>
            </tr>
        </table>
        <div class="totalvalue">
            <p class="total">Total</p>
            <p class="total__value">Rs.{{ $details['details']['order']['total_amount'] }}</p>
        </div>
    </div>

    <!-- Order Details -->

    <div class="order__details">
        <div class="billing__address">
            <h2>Billing Address</h2>
            <p>{{ $details['details']['address']['fname'] . ' ' . $details['details']['address']['lname'] }}</p>
            <p>{{ $details['details']['address']['address'] }}</p>
            <p>{{ $details['details']['address']['city'] }} {{ $details['details']['address']['zip'] }}</p>
            <p>{{ $details['details']['address']['state'] }} {{ $details['details']['address']['country'] }}</p>
            <p>{{ $details['details']['address']['phone'] }}</p>
        </div>
        <div class="shipping__address">
            <h2>Shipping Address</h2>
            <p>{{ $details['details']['address']['fname'] . ' ' . $details['details']['address']['lname'] }}</p>
            <p>{{ $details['details']['address']['address'] }}</p>
            <p>{{ $details['details']['address']['city'] }} {{ $details['details']['address']['zip'] }}</p>
            <p>{{ $details['details']['address']['state'] }} {{ $details['details']['address']['country'] }}</p>
            <p>{{ $details['details']['address']['phone'] }}</p>
        </div>
        <div class="shipping__method">
            <h2>Shipping method</h2>
            <p>{{ $details['details']['payment_method'] }}</p>
        </div>
    </div>
    </div>
@endsection
