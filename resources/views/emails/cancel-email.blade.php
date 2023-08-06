@extends('emails.layout')
@section('content')
<div class="orderid__details">
    <p>[Order #{{ $details['details']['order']['order_no'] }}]</p>
  </div>

  <!-- Purchase -->

  <p class="thankforpurchase">
    Your order is cancel</p>
  <br>
  <!-- Order Reminder -->

  <p class="orderreminder">
    We are sorry to inform your that. Your order has been marked cancelled to our system.
  </p>

  <!-- Buttons -->
  <div class="buttons">
    <a href="{{ route('website.order.complete-order', $details['details']['order']['order_no']) }}" class="btn btn__vieworder">View Order</a>
    <span>Or</span>
    <a href="{{ route('website.home.index') }}" class="btn btn__visitourstore">Visit our store</a>
  </div>
  <!-- Order Summary Section -->
  <div class="order__summary">
    <p class="ordersummary">Order Details</p>
    <div class="summary__block">
    @foreach ($details['details']['orderItems'] as $item)
    <div class="summary">
        <div class="summary__details">
          <a href="{{ route('website.home.book-detail-view', $item['book']['slug']) }}"><img src="{{ asset('storage/'. $item['book']['images'][0]['filename'] ) }}" alt="{{ $item['book']['name'] }}" width="300" height="200"/></a>
          <a href="{{ route('website.home.book-detail-view', $item['book']['slug']) }}"><p class="product__name">{{ $item['book']['name'] }}</p>
          </a>
          <p class="product__quantity">{{ intval($item['qty']) }} x {{ intval($item['price']) }}</p>
        </div>

        <p class="product__price">Rs.{{ $item['total_amount'] }}</p>
    </div>
    @endforeach

    </div>
  </div>

</div>
@endsection
