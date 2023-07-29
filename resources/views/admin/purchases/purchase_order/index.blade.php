@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Purchase Order</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Purchase Order List
        <a href="{{ route('admin.purchase-order.create') }}" class="btn btn-primary btn-sm float-end" id="openCreateCategorModal"><i class="fa fa-plus"></i> Add New</a>
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="purchaseOrderTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>PO Date</th>
                  <th>PO No.</th>
                  <th>Supplier Name</th>
                  <th>Delivery</th>
                  <th>Order Qty</th>
                  <th>Order Value</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">

              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@include('admin.purchases.purchase_order.js.index')
@endsection
