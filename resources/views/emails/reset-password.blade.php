
@extends('emails.layout')
@section('content')

  <!-- Purchase -->

  <p class="thankforpurchase">Reset your password</p>

  <!-- Order Reminder -->

  <p class="orderreminder">
    Follow this link to reset your customer account password at <a href="{{ route('website.home.index') }}">Kitan Jahan</a>. If you didn't request a new password, you can safely delete this email.
  </p>

  <!-- Buttons -->
  <div class="buttons">
    <a href="{{ $details['details']['link'] }}" class="btn btn__vieworder">Reset Password</a>
    <span>Or</span>
    <a href="{{ route('website.home.index') }}" class="btn btn__visitourstore">Visit our store</a>
  </div>

</div>
@endsection
