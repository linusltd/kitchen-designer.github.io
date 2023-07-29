@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-2">Suppliers</h4>
    <!-- Basic Bootstrap Table -->
    <div class="row">
        <div class="col-8">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="fas fa-edit"></i> Edit New</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('admin.suppliers.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $supplier->name }}">
                      </div>
                      <div class="col-6">
                        <label class="form-label" for="contact_person">Contact Person <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact_person" placeholder="Contact Person" value="{{ $supplier->contact_person }}">
                      </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="mobile">Mobile <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="mobile" placeholder="mobile" value="{{ $supplier->mobile }}"/>
                      </div>
                      <div class="col-6">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="phone" value="{{ $supplier->phone }}"/>
                      </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="opening_balance">Opening Balance</label>
                        <input type="text" name="opening_balance" class="form-control phone-mask" placeholder="Opening Balance" value="{{ $supplier->opening_balance }}"/>
                      </div>
                      <div class="col-6">
                        <label class="form-label" for="opening_date">Opening Date <span class="text-danger">*</span></label>
                        <input type="date" name="opening_date" class="form-control phone-mask" placeholder="Opening Balance" value="{{ $supplier->opening_date }}"/>
                      </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                  <textarea name="address" class="form-control" placeholder="Address">{{ $supplier->address }}</textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                        <select name="city" class="form-control">
                            <option value="">---select city ---</option>
                            @foreach ($cities as $item)
                                <option value="{{ $item->name }}" @selected($item->name == $supplier->city)>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="0" @selected($supplier->status == 0)>Active</option>
                            <option value="1" @selected($supplier->status == 1)>Inactive</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
@include('admin.parameters.suppliers.js.edit')
@endsection
