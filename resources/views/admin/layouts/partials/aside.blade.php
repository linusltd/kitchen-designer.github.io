<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
            <img src="{{ asset('storage/' . getGeneral()->logo) }}" alt="Logo">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <!-- Administration -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Layouts">Administration</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.role.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Staff Role</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Role Permission</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.staff.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Manage Staff</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Categories -->
        <li class="menu-item {{ request()->routeIs('categories.*, authors.*, suppliers.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Layouts">Parameters</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Categories</div>
                    </a>
                </li>
                {{-- <li class="menu-item">
                    <a href="{{ route('admin.authors.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Authors</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.suppliers.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Suppliers</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        <!-- Products -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store-alt"></i>
                <div data-i18n="Layouts">Products</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.books.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Manage Product</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.books.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Add Product</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.reviews.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Manage Reviews</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Orders -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="Layouts">Orders</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.order.pending') }}" class="menu-link">
                        <div data-i18n="Without menu">Manage Orders</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.cart.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Manage Carts</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Purchases -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="Layouts">Purchases</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.purchase-order.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Purchase Order</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Purchase Return</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Customers -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Layouts">Customers</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.customer.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Manage Customer</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.quries.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Quries</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Accounts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-bank"></i>
                <div data-i18n="Layouts">Accounts</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.account.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Manage Accounts</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.voucher.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Manage Voucher</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.cash-payment-voucher.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Cash Payment Voucher</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.cash-receipt-voucher.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Cash Receipt Voucher</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.cash-book.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Cash Book</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.ledger.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Search Ledger</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.account-summary.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Accunt Summary</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- CMS Section -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">CMS</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.general.index') }}" class="menu-link">
                        <div data-i18n="Without menu">General</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.slider.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Slider</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Cargo Services -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-truck"></i>
                <div data-i18n="Layouts">Cargo Services</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.books.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Manage Products</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu -->
