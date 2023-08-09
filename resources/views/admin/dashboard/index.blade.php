@extends('admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Pending Orders</span>
                                <a href="{{ route('admin.order.pending') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $todayPendingOrdersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Shipped Orders</span>
                                <a href="{{ route('admin.order.shipped') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $totalShippedOrdersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Today Active Cart</span>
                                <a href="{{ route('admin.reviews.index') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $toDayCartCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Total Active Cart</span>
                                <a href="{{ route('admin.cart.index') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $totalCartCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Customers</span>
                                <a href="{{ route('admin.customer.index') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $customersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Total Orders</span>
                                <a href="{{ route('admin.order.index') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $totalOrdersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Total Delivered</span>
                                <a href="{{ route('admin.order.delivered') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $totalDeliveredOrdersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Total Cancelled Orders</span>
                                <a href="{{ route('admin.order.cancelled') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $totalCancelledOrdersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Total Failed Delivery Orders</span>
                                <a href="{{ route('admin.order.failed-delivery') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $totalFailedDeliveredOrdersCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">Online Products</span>
                                <a href="{{ route('admin.books.index') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $onlineProductsCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/admin') }}/img/icons/unicons/chart-success.png"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1" style="font-size:18px">New Reviews</span>
                                <a href="{{ route('admin.reviews.index') }}">
                                    <h3 class="card-title mb-2" style="color: black; text-decoration:underline">{{ $reviewsCount }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
