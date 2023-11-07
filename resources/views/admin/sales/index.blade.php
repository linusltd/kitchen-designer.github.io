@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Sales Order</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Sales Order List
                <a href="{{ route('admin.sales-order.create') }}" class="btn btn-primary btn-sm float-end"
                    id="openCreateCategorModal"><i class="fa fa-plus"></i> Add New</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="salesOrderTable">
                        <thead>
                            <tr>
                                <th>sr. #</th>
                                <th>SO Date</th>
                                <th>SO No.</th>
                                <th>Party Name</th>
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
    </div>
    <!--/ Basic Bootstrap Table -->
    @include('admin.sales.js.index')
@endsection
