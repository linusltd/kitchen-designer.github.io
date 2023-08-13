<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="">
            Visit Your Site =>  <a href="{{ route('website.home.index') }}" target="_blank">{{" "}} {{ route('website.home.index') }}</a>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            {{-- <li class="nav-item lh-1 me-3">
                <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star" data-size="large" data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
            </li> --}}

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="" href="javascript:void(0);">
                    <span class="fw-semibold d-block">{{ Auth::guard('admin')->user()->name }} (<small class="text-muted">Admin</small>)</span>
                </a>
            </li>

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="dropdown-item" href="{{ route('admin.auth.logout') }}">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                </a>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->


