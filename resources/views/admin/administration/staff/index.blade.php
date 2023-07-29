@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Staff</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Manage List
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm float-end text-white"><i class="fa fa-plus"></i> Add New</a>
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="roleTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Role</th>
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
@include('admin.administration.staff.js.index')
@endsection
