@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Slider</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Slider List
        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary btn-sm float-end" id="openCreateCategorModal"><i class="fa fa-plus"></i> Add New</a>
      </h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="purchaseOrderTable">
              <thead>
                <tr>
                  <th>sr. #</th>
                  <th>Image</th>
                  <th>Redirect</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($sliders as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" alt="" height="200px" width="200px"></td>
                        <td><a href="#" class="btn btn-success">Redirect</a></td>
                        <td>{{ $item->type == 0 ? 'Home' : 'Shop' }}</td>
                        <td>
                            @if ($item->status == 0)
                                <span class="badge bg-label-primary me-1">Active</span>
                            @else
                                <span class="badge bg-label-danger me-1">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.slider.edit', $item->id) }}" class="edit text-success me-2" style="cursor:pointer"><i class="bx bx-edit-alt "></i>Edit</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@include('admin.cms.slider.js.index')
@endsection
