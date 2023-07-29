@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Manage Customers Quries</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Customer Quries List
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="categoryTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Query</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($quries as $key => $query)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $query->name }}</td>
                    <td>{{ $query->email }}</td>
                    <td>{{ $query->phone }}</td>
                    <td>{{ $query->query }}</td>
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
