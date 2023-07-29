@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Vouchers</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Voucher List
          <a href="{{ route('admin.cash-receipt-voucher.index') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus"></i> Cash Receipt Voucher</a>
          <a href="{{ route('admin.cash-payment-voucher.index') }}" class="btn btn-primary btn-sm float-end me-2"><i class="fa fa-plus"></i> Cash Payment Voucher</a>
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="categoryTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Voucher ID</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($vouchers as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->voucher_id }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->created_at->format('d-M-Y') }}</td>
                        <td>
                            @if ($item->type == 0)
                                Payment
                            @else
                                Receipt
                            @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@include('admin.accounts.voucher.js.index')
@endsection
