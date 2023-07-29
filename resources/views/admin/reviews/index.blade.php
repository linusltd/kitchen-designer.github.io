@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Reviews</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Reviews List
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="categoryTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Book</th>
                  <th>Content</th>
                  <th>Rating</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($reviews as $key => $review)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        <a href="{{ route('website.home.book-detail-view', $review->book->slug) }}" target="_blank">
                        {{ $review->book->name }}
                        </a>
                    </td>
                    <td>
                        <div style="display:flex;flex-direction:column">
                            <div style="color:black">{{ $review->review }}</div>
                            <span>{{ $review->name }} {{ \Carbon\Carbon::parse($review->created_at)->format('j F, Y') }}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <div style="display:flex;align-items:center;gap:10px">
                            <span>{{ $review->ratings }}</span>
                            <img src="{{ asset('assets/website/images/review_star.svg') }}" alt="">
                        </div>
                    </td>
                    <td>
                        <form id="myForm" action="{{ route('admin.reviews.update-review-status') }}" method="GET">
                            <input type="hidden" name="id" value="{{ $review->id }}">
                            <select id="mySelect" name="is_verified" class="form-control">
                                <option value="0" @selected(0 == $review->is_verified)>Not Verified</option>
                                <option value="1" @selected(1 == $review->is_verified)>Verfied</option>
                                <option value="2" @selected(2 == $review->is_verified)>Rejected</option>
                            </select>
                        </form>
                    </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@include('admin.reviews.js.index')
@endsection
