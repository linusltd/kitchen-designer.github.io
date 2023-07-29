@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-center"><i class="fas fa-money text-success"></i> CASH PAYMENT VOUCHER</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body">
                <form action="" onsubmit="return false" id="makePaymentEntryForm">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="account_id">Account</label>
                                <select name="account_id" id="account_id" class="form-control">
                                    <option value="">---select account---</option>
                                    @foreach ($accounts as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="date">Narration</label>
                            <input type="text" name="narration" id="narration" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date">Bill No.</label>
                            <input type="text" name="bill_no" id="bill_no" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3 justify-content-center">
                            <center> <button type="submit" class="btn btn-danger btn-md"><i class="fas fa-plus"></i>
                                    Add</button></center>
                        </div>
                    </div>
                </form>
                <form action="" onsubmit="return false" id="updatePaymentEntryForm" class="d-none">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="account_id">Account</label>
                                <select name="account_id" id="account_id" class="form-control">
                                    <option value="">---select account---</option>
                                    @foreach ($accounts as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="date">Narration</label>
                            <input type="text" name="narration" id="narration" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date">Bill No.</label>
                            <input type="text" name="bill_no" id="bill_no" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3 justify-content-center">
                            <center> <button type="submit" class="btn btn-primary btn-md"><i class="fas fa-edit"></i>
                                    Update</button> <button type="submit" class="btn btn-secondary btn-md"
                                    id="cancelBtn"><i class="fas fa-close"></i>
                                    Cancel</button></center>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <form action="{{ route('admin.cash-payment-voucher.store') }}" method="POST"
                        id="savePayementVoucherForm">
                        @csrf
                        <input type="hidden" name="amount">
                        <div class="col-md-12 mb-3">
                            <table class="table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white" width="5%">#</th>
                                        <th class="text-white" width="10%">Acc-ID</th>
                                        <th class="text-white" width="20%">Acc Title</th>
                                        <th class="text-white" width="10%">Date</th>
                                        <th class="text-white" width="7%">Amount</th>
                                        <th class="text-white" width="25%">Narration</th>
                                        <th class="text-white" width="8%">Bill No.</th>
                                        <th class="text-white" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                                <tfoot id="tfoot" style="background-color: #9396ffd9" class="d-none">
                                    <tr>
                                        <th class="text-white" colspan="4" style="text-align: right">Total</th>
                                        <th class="text-white" id="total">0</th>
                                        <th class="text-white" colspan="3"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr />
                        <div class="col-12">
                            <center><button type="submit" class="btn btn-success btn-lg d-none"
                                    id="savePaymentVoucher">Save</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('admin.accounts.cashpaymentvoucher.js.index')
    @endsection
