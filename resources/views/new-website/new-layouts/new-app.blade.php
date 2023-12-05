<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    @include('new-website.new-layouts.partials.header')
    <title>@yield('title')</title>
    @yield('seo')
</head>

<body>
    @php $general = getGeneral();  @endphp
    {{-- Navbar --}}
    @include('new-website.new-layouts.partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    <div class="whatsapp-btn">
        <a href="https://wa.me/+923004716058">
            <img src="{{ asset('assets/website/images/whatsapp.png') }}" alt="">
        </a>
    </div>
    {{-- Footer --}}
    @include('new-website.new-layouts.partials.footer')

    {{-- Modals --}}
    @include('new-website.new-layouts.partials.modals')

    {{-- Scripts --}}
    @include('new-website.new-layouts.partials.scripts')
</body>

</html>
