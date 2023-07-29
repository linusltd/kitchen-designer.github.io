@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Staff Roles</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Roles List
        <button type="button" class="btn btn-primary btn-sm float-end" id="openRoleModal"><i class="fa fa-plus"></i> Add New</button>
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="roleTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Name</th>
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
@include('admin.administration.role.modals')
@include('admin.administration.role.js.index')
@endsection
