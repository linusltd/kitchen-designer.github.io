{{-- <x-mail::message>
# Introduction

The body of your message.



<a href="{{ $details['details']['link'] }}">
    Click To Verify Your Email
</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}
@extends('emails.layout')
@section('content')
<div class="orderid__details">
    <p>[Order #177201]</p>
    <p>(April 4, 2023)</p>
  </div>

  <!-- Purchase -->

  <p class="thankforpurchase">Thank you for your purchase</p>

  <!-- Order Reminder -->

  <p class="orderreminder">
    Thanks for your order. It’s on-hold until we confirm that payment has
    been received. In the meantime, here’s a reminder of what you ordered:
  </p>

  <!-- Buttons -->
  <div class="buttons">
    <a href="#" class="btn btn__vieworder">View Order</a>
    <span>Or</span>
    <a href="{{ route('website.home.index') }}" class="btn btn__visitourstore">Visit our store</a>
  </div>

  <!-- Order Summary Section -->

  <div class="order__summary">
    <p class="ordersummary">Order Summary</p>
    <div class="summary__block">
      <div class="summary">
        <div class="summary__details">
          <img src="{{ asset('assets/website/images/book1.jpg') }}" alt="" />
          <p class="product__name">Arth Shastra</p>
          <p class="product__quantity">x1</p>
        </div>

        <p class="product__price">Rs.1500</p>
      </div>
      <div class="summary">
        <div class="summary__details">
          <img src="{{ asset('assets/website/images/book1.jpg') }}" alt="" />
          <p class="product__name">Arth Shastra</p>
          <p class="product__quantity">x1</p>
        </div>

        <p class="product__price">Rs.1500</p>
      </div>
      <div class="summary">
        <div class="summary__details">
          <img src="{{ asset('assets/website/images/book1.jpg') }}" alt="" />
          <p class="product__name">Arth Shastra</p>
          <p class="product__quantity">x1</p>
        </div>

        <p class="product__price">Rs.1500</p>
      </div>
    </div>
  </div>

  <!-- Total Price -->

  <div class="total__price">
    <table>
      <tr>
        <td class="subtotal">Sub Total</td>
        <td class="subtotal__value">Rs.3000</td>
      </tr>
      <tr>
        <td class="shippingcharges">Shipping Charges</td>
        <td class="shippingcharges__value">Rs.500</td>
      </tr>
    </table>
    <div class="totalvalue">
      <p class="total">Total</p>
      <p class="total__value">Rs.3500</p>
    </div>
  </div>

  <!-- Order Details -->

  <div class="order__details">
    <div class="billing__address">
      <h2>Billing Address</h2>
      <p>Admin Admin</p>
      <p>kashmir Road Zahid Colony</p>
      <p>Gujranwala</p>
      <p>Gujranwala 52250</p>
      <p>Pakistan</p>
      <p>+92 300 1234567</p>
    </div>
    <div class="shipping__address">
      <h2>Shipping Address</h2>
      <p>Admin Admin</p>
      <p>kashmir Road Zahid Colony</p>
      <p>Gujranwala</p>
      <p>Gujranwala 52250</p>
      <p>Pakistan</p>
      <p>+92 300 1234567</p>
    </div>
    <div class="shipping__method">
      <h2>Shipping method</h2>
      <p>Delivery Charges</p>
    </div>
  </div>
</div>
@endsection
