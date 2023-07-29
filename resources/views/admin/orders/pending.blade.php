@extends('admin.layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-1">Orders Management</h4>
    <a href="#" class="btn btn-primary mb-3" id="pritnShippingLabels"><i class="fa fa-print"></i> Print Shipping Label For Selected</a>
     <!-- Tabs -->
     <div class="row">
       <div class="col-12">
         <div class="nav-align-top mb-4">
           <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
                <a
                href="{{ route('admin.order.index') }}"
                class="nav-link"
                role="tab"
              >
                All
              </a>
             </li>
             <li class="nav-item">
               <a
                 href="{{ route('admin.order.pending') }}"
                 class="nav-link active"
                 role="tab"
               >
                 Pending ({{$pendingOrdersCount}})
               </a>
             </li>
             <li class="nav-item">
                <a
                  href="{{ route('admin.order.shipped') }}"
                  class="nav-link"
                >
                 Shipped ({{$shippedOrdersCount}})
                </a>
              </li>
             <li class="nav-item">
                <a
                    href="{{ route('admin.order.delivered') }}"
                    class="nav-link"
                >
                 Delivered ({{ $deliveredOrdersCount }})
                </a>
             </li>
             <li class="nav-item">
                <a
                    href="{{ route('admin.order.cancelled') }}"
                    class="nav-link"
                >
                 Cancelled ({{ $cancelledOrdersCount }})
                </a>
             </li>
             <li class="nav-item">
                <a
                    href="{{ route('admin.order.failed-delivery') }}"
                    class="nav-link"
                >
                  Failed Delivery ({{ $failedDeliveryOrdersCount }})
                </a>
              </li>
              <li class="nav-item">
                <a
                    href="{{ route('admin.order.cancel-request') }}"
                    class="nav-link"
                >
                  Cancel Requests ({{ $cancelRequestOrdersCount }})
                </a>
              </li>
           </ul>
           <div class="tab-content">
             <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <td width="1%"><input type="checkbox" class="check-all" style="cursor: pointer"></td>
                        <td width="1%"></td>
                        <th width="1%">Order No.</th>
                        <th width="10%">Order Date</th>
                        <th width="10%">Payment Method</th>
                        <th width="10%">Total Amount</th>
                        <th width="10%">Total Items</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="categoryTable">
                        @foreach ($pendingOrders as $order)
                        <tr>
                            <td><input type="checkbox" class="check-row" value="{{ $order->id }}" style="cursor: pointer"></td>
                            <td><i class="toggle-button fas fa-plus cursor-pointer" data-id="{{ $order->id }}"></i></td>
                            <td><a href="">#{{ $order->order_no }}</a></td>
                            <td>{{  \Carbon\Carbon::parse($order->received_at)->format('d M Y H:i') }}</td>
                            <td>Cash on delivery</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>
                                @if ($order->status == 0)
                                    Pending
                                @elseif ($order->status == 1)
                                    Delivered
                                @elseif ($order->status == 3)
                                    Shipped
                                @elseif ($order->status == 2)
                                    Cancelled
                                @elseif ($order->status == 4)
                                    Cancel Request
                                @elseif ($order->status == 5)
                                    Failed Delivery
                                @endif
                            </td>
                            <td>
                                <form id="myForm" action="{{ route('admin.order.change-order-status') }}" method="GET">
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <select name="status" id="mySelect" class="form-control">
                                        <option value="0">Pending</option>
                                        <option value="3">Ready To Ship</option>
                                        <option value="2"> Cancel Order</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        {{-- Nested Table --}}
                        <tr class="nested-table-{{$order->id}}" style="display: none">
                            <td colspan="9">
                                <table class="nested-table table">
                                    <thead>
                                        <tr>
                                            <td width="20%">Sending To</td>
                                            <td width="10%">Image</td>
                                            <td width="10%">Product</td>
                                            <td width="5%">Price</td>
                                            <td width="5%">Quantity</td>
                                            <td width="10%">Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->order_items as $item)
                                        <tr>
                                            <td>
                                                <p class="m-0">{{ $order->address->fname .' '. $order->address->lname }}</p>
                                                <p class="m-0">{{ $order->address->address }}</p>
                                                <p class="m-0">{{ $order->address->city  .' '. $order->address->zip }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('website.home.book-detail-view', $item->book->slug) }}" target="_blank">
                                                    <img src="{{ asset('storage/'. $item->book->images[0]->filename ) }}" alt="{{ $item->book->title }}" style="height:100px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('website.home.book-detail-view', $item->book->slug) }}" target="_blank">
                                                    {{ $item->book->name }}
                                                </a>
                                            </td>
                                            <td>{{ intval($item->price)}}</td>
                                            <td>{{ intval($item->qty)}}</td>
                                            <td>{{ $item->total_amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pendingOrders->links() }}
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- Tabs -->
</div>
@endsection
