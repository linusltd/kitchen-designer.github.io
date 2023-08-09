@extends('admin.layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-1">Orders Management</h4>
     <!-- Tabs -->
     <div class="row">
       <div class="col-12">
         <div class="nav-align-top mb-4">

           <div class="tab-content">
             <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <td width="1%"></td>
                        <th width="10%">Order Date</th>
                        <th width="10%">Total Amount</th>
                        <th width="10%">Total Items</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="categoryTable">
                        @foreach ($carts as $cart)
                        <tr>
                            <td><i class="toggle-button fas fa-plus cursor-pointer" data-id="{{ $cart->id }}"></i></td>
                            <td>{{  \Carbon\Carbon::parse($cart->updated_at)->format('d M Y H:i') }}</td>

                            <td>{{ $cart->original_total_price }}</td>
                            <td>{{ $cart->item_count }}</td>
                        </tr>
                        {{-- Nested Table --}}
                        <tr class="nested-table-{{$cart->id}}" style="display: none">
                            <td colspan="7">
                                <table class="nested-table table">
                                    <thead>
                                        <tr>
                                            <td width="10%">Image</td>
                                            <td width="10%">Product</td>
                                            <td width="5%">Price</td>
                                            <td width="5%">Quantity</td>
                                            <td width="10%">Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->cart_items as $item)
                                        <tr>
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
                                            <td>{{ intval($item->quantity)}}</td>
                                            <td>{{ $item->total_price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $carts->links() }}
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- Tabs -->
</div>
@endsection
