@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Customers</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Customers List
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="categoryTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Total Orders</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($users as $key => $user)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->orders->count() }}</td>
                    <td><a href="{{ route('admin.customer.show', $user->id) }}" class="edit text-success me-2" style="cursor:pointer">View Details</a></td>
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
