@extends('admin.layouts.master')

@section('content')
    <div class="container-xl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Create New Staff</h4>
        <!-- Basic Bootstrap Table -->
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <form action="" onsubmit="return false" id="savePayementVoucherForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="account_id">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="account_id">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" placeholder="Email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="account_id">Phone</label>
                                        <input type="text" name="phone" placeholder="Phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="account_id">Salary</label>
                                        <input type="number" name="salary" placeholder="Salary" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="date">Address</label>
                                    <input type="text" name="address" placeholder="address" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label for="date">Role <span class="text-danger">*</span></label>
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">--select role--</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label for="date">Image</label>
                                    <input type="file" name="image" placeholder="Image"  class="form-control"/>
                                </div>
                                <div class="col-12">
                                    <center><button type="submit" class="btn btn-success btn-md"
                                            id="savePaymentVoucher">Submit</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.administration.staff.js.create')
    @endsection
