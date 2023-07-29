
@extends('emails.layout')
@section('content')

  <!-- Purchase -->

  <p class="thankforpurchase">Contact Us Query</p>
    <br>
  <!-- Order Reminder -->

  <p class="orderreminder">
    <p><strong>Name:</strong> {{ $details['details']['name'] }}</p>
    <p><strong>Email:</strong> {{ $details['details']['email'] }}</p>
    <p><strong>Phone:</strong> {{ $details['details']['phone'] }}</p>
    <p><strong>Query:</strong> {{ $details['details']['query'] }}</p>
  </p>



</div>
@endsection
