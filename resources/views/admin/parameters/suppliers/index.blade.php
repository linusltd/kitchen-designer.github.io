@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Suppliers</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Supplier List
        <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary btn-sm float-end" id="openCreateCategorModal"><i class="fa fa-plus"></i> Add New</a>
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="SupplierTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Name</th>
                  <th>Contact Person</th>
                  <th>Mobile</th>
                  <th>City</th>
                  <th>Opening Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
            </table>
          </div>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
@include('admin.parameters.suppliers.js.index')
@endsection
