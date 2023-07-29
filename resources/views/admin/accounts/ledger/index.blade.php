@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-center"><i class="fas fa-search text-success"></i> SEARCH LEDGER BY DATE</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body">
                <form action="" onsubmit="return false" id="makePaymentEntryForm">
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3">
                            <label for="date">Accounts</label>
                            <select name="account_id" id="account_id" class="form-control">
                                <option value="">---select account---</option>
                                @foreach ($accounts as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="date">From</label>
                            <input typex="date" name="from" id="from" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="date">To</label>
                            <input type="date" name="to" id="to" class="form-control">
                        </div>
                        <div class="col-md-1 mb-3 p-0">
                            <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <table class="table">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white" width="5%">#</th>
                                    <th class="text-white" width="10%">Date</th>
                                    <th class="text-white" width="40%">Narration</th>
                                    <th class="text-white" width="10%">Debit</th>
                                    <th class="text-white" width="10%">Credit</th>
                                    <th class="text-white" width="10%">Balance</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.accounts.ledger.js.index')
    @endsection
