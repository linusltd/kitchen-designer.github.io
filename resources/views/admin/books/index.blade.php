@extends('admin.layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-1">Product Management</h4>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add New Product</a>
    <a href="{{ route('admin.books.get-books-excel') }}" class="btn btn-danger mb-3"><i class="fa fa-plus"></i> Export Products</a>
     <!-- Tabs -->
     <div class="row">
       <div class="col-12">
         <div class="nav-align-top mb-4">
           <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
               <button
                 type="button"
                 class="nav-link"
                 role="tab"
                 data-bs-toggle="tab"
                 data-bs-target="#navs-top-home"
                 aria-controls="navs-top-home"
                 aria-selected="true"
               >
                 All
               </button>
             </li>
             <li class="nav-item">
               <a
                 href="{{ route('admin.books.index') }}"
                 class="nav-link active"
                 role="tab"
               >
                 Online ({{$onlineProductsCount}})
               </a>
             </li>
             <li class="nav-item">
                <a
                  href="{{ route('admin.books.draft') }}"
                  class="nav-link"
                >
                 Draft ({{$draftProductsCount}})
                </a>
              </li>
             <li class="nav-item">
               <button
                 type="button"
                 class="nav-link"
                 role="tab"
                 data-bs-toggle="tab"
                 data-bs-target="#navs-top-messages"
                 aria-controls="navs-top-messages"
                 aria-selected="false"
               >
                 Pending (0)
               </button>
             </li>
             <li class="nav-item">
               <button
                 type="button"
                 class="nav-link"
                 role="tab"
                 data-bs-toggle="tab"
                 data-bs-target="#navs-top-messages"
                 aria-controls="navs-top-messages"
                 aria-selected="false"
               >
                 Out Of Stock (0)
               </button>
             </li>
             <li class="nav-item">
               <button
                 type="button"
                 class="nav-link"
                 role="tab"
                 data-bs-toggle="tab"
                 data-bs-target="#navs-top-messages"
                 aria-controls="navs-top-messages"
                 aria-selected="false"
               >
                 Inactivate (0)
               </button>
             </li>
             <li class="nav-item">
               <button
                 type="button"
                 class="nav-link"
                 role="tab"
                 data-bs-toggle="tab"
                 data-bs-target="#navs-top-messages"
                 aria-controls="navs-top-messages"
                 aria-selected="false"
               >
                 Suspended (0)
               </button>
             </li>
             <li class="nav-item">
               <button
                 type="button"
                 class="nav-link"
                 role="tab"
                 data-bs-toggle="tab"
                 data-bs-target="#navs-top-messages"
                 aria-controls="navs-top-messages"
                 aria-selected="false"
               >
                 Deleted (0)
               </button>
             </li>
           </ul>
           <div class="tab-content">
             <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                <div class="table-responsive text-nowrap">
                <table class="table" id="categoryTable">
                    <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="10%">Product</th>
                        <th width="10%">SKU</th>
                        <th width="10%">Price</th>
                        <th width="10%">Stock</th>
                        <th width="10%">Created</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($onlineProducts as $count => $book)
                        <tr>
                            <td>{{ ++$count }}</td>
                            <td>
                                <div class="title-wrapper">
                                    <div class="image-wrapper">
                                        <a href="{{ route('website.home.book-detail-view', $book->slug) }}" target="_blank">
                                            <img src="{{ asset('storage/'. $book->images[0]->filename ) }}" alt="{{ $book->name }}" width="74px" height="64px">
                                        </a>
                                    </div>
                                    <p>
                                        <a href="{{ route('website.home.book-detail-view', $book->slug) }}" target="_blank">
                                            {{ $book->name }}
                                        </a>
                                    </p>
                                </div>
                            </td>
                            <td>{{ $book->sku }}</td>
                            <td>{{ $book->price }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>{{ $book->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.books.edit', $book->id) }}" target="_blank" class="">Edit</a>
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="text-danger">Deactivate</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- Tabs -->
</div>
@include('admin.books.js.index')
@endsection
