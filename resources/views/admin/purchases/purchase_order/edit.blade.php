@extends('admin.layouts.master')

@section('content')
@push('styles')
    <style>
        .disabled{
            cursor: default;
            background-color: -internal-light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3));
            color: -internal-light-dark(rgb(84, 84, 84), rgb(170, 170, 170));
            border-color: rgba(118, 118, 118, 0.3);
        }
    </style>
@endpush
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-2">Suppliers</h4>
    <!-- Basic Bootstrap Table -->
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="fas fa-edit"></i> Edit Purchase Order</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('admin.purchase-order.update', $order->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $order->id }}">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="supplier_id">Supplier <span class="text-danger">*</span></label>
                        <select name="supplier_id" class="form-control">
                            <option value="">---select supplier---</option>
                            @foreach ($suppliers as $item)
                                <option value="{{ $item->id }}" @selected($order->orderable_id == $item->id)>{{ $item->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-6">
                          <label class="form-label" for="reference_no">Reference No. </label>
                          <input type="text" class="form-control" name="reference_no" placeholder="Reference no." value="{{ $order->reference_no }}"/>
                        </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="issue_date">Issue Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="issue_date" placeholder="" value="{{ $order->issue_date }}"/>
                      </div>
                      <div class="col-6">
                        <label class="form-label" for="delivery_date">Delivery Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="delivery_date" placeholder="phone" value="{{ $order->delivery_date }}"/>
                        <input type="hidden" name="total_qty" value="{{ $order->qty }}">
                        <input type="hidden" name="total_order_amount" value="{{ $order->total_amount }}">
                      </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label class="form-label" for="status">Status<span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" {{ $order->status == 1 ? 'disabled' : '' }}>
                            <option value="0" @selected($order->status == 0)>Open</option>
                            <option value="1" @selected($order->status == 1)>Complete</option>
                            <option value="2" @selected($order->status == 2)>Cancelled</option>
                        </select>
                      </div>
                      <div class="col-12">
                        <button type="button" class="btn btn-primary" id="OpenLoadProductsModel"><i class="fas fa-spinner"></i> Load Products For Order</button>
                      </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="text-white">#.</th>
                                    <th class="text-white">Book Name</th>
                                    <th class="text-white">SKU</th>
                                    <th class="text-white">Price</th>
                                    <th class="text-white">Disc. %</th>
                                    <th class="text-white">Qty.</th>
                                    <th class="text-white">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="loadPurchaseItems">
                                @if ($order->order_items->count())
                                    @foreach ($order->order_items as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->book->name }}</td>
                                            <td>{{ $item->book->sku }}</td>
                                            <td>
                                            <input type="hidden" name="book_id[]" value="{{ $item->book_id }}"/>
                                            <input type="number" style="width:80%;height:35px" name="price[]" id="price" value="{{ $item->price }}" class="disabled" readonly/></td>
                                            <td><input type="number" style="width:80%;height:35px" name="discount_percentrage[]" id="discount_percentrage" value="{{ $item->discount }}"/></td>
                                            <td><input type="number" style="width:80%;height:35px" name="qty[]" id="qty" value="{{ $item->qty }}"/></td>
                                            <td><input type="number" style="width:80%;height:35px;margin-right:10px" name="total_amount[]" id="total_amount" value="{{ $item->total_amount }}" class="disabled" readonly/>
                                            <i class="fas fa-trash text-danger cursor-pointer" id="deleteOrderRow" data-id="${id}"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot  class="bg-secondary">
                                <tr>
                                    <th colspan="3"></th>
                                    <th class="text-white" id="totalPrice">0</th>
                                    <th class="text-white">-</th>
                                    <th class="text-white" id="totalQty">{{ $order->qty }}</th>
                                    <th class="text-white" id="totalAmount">{{ $order->total_amount }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end" {{$order->status == 1 ? 'disabled' : ''}}>{{$order->status == 1 ? "Can't updated completed orders" : 'Submit'}}</button>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
@include('admin.purchases.purchase_order.modals')
@include('admin.purchases.purchase_order.js.edit')
@endsection
