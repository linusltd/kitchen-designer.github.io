@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Customers</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Customers Details
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="categoryTable">
              <thead>
                <tr>
                    <td>#</td>
                    <th>Order No</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($user->orders as $key => $item)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>#{{ $item->order_no }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->received_at)->format('F j, Y') }}</td>
                    <td>
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
                        @endif
                    </td>
                    <td>{{ $item->total_amount }}</td>
                    <td>
                        <a href="{{ route('website.order.complete-order', $item->order_secret) }}" target="_blank" class="edit text-success me-2" style="cursor:pointer">View Order</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@include('admin.customer.js.index')
@endsection
