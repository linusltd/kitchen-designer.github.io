<ul class="profile__navigation">
    <li class="{{ request()->routeIs('website.profile.index') ? 'nav__active' : '' }}">
        <a href="{{ route('website.profile.index') }}">Dashboard</a>
    </li>
    <li class="{{ request()->routeIs('website.profile.my-orders') ? 'nav__active' : '' }}">
        <a href="{{ route('website.profile.my-orders') }}">My Orders</a>
    </li>
    <li class="{{ request()->routeIs('website.profile.update') ? 'nav__active' : '' }}">
        <a href="{{ route('website.profile.update') }}">Addresses</a>
    </li>
    {{-- <li class="{{ request()->routeIs('website.profile.change-password') ? 'nav__active' : '' }}">
        <a href="{{ route('website.profile.change-password') }}">Change Password</a>
    </li> --}}
    <li><a href="{{ route('website.auth.logout') }}">Logout</a></li>
</ul>
