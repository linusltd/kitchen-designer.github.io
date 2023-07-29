@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Accounts</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Account List
                <button type="button" class="btn btn-primary btn-sm float-end" id="openCreateCategorModal"><i
                        class="fa fa-plus"></i> Add New</button>
            </h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="accountTable">
                        <thead>
                            <tr>
                                <th>sr. #</th>
                                <th>Account ID</th>
                                <th>Title</th>
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
        @include('admin.accounts.account.modals')
        @include('admin.accounts.account.js.index')
    @endsection
