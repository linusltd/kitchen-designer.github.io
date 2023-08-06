<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C8577EBJ6L"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-C8577EBJ6L');
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('website.layouts.partials.header')
    <title>@yield('title')</title>
    @yield('seo')
</head>
<body>
    @php $general = getGeneral();  @endphp
    <!-- Layout Wrapper -->
    <div class="container-fluid-xl">

        <!-- Navbar -->
        @include('website.layouts.partials.navbar')
        <!-- /Navbar -->

        <!-- Content -->
        <div style="margin-top: 113px;">
            @yield('content')

        </div>
        <!-- /Content -->

        <!-- Scroll To Up Button -->
        <button id="scrollToTopBtn" title="Go to top">&#8593;</button>
        <div class="whatsapp-btn">
            <a href="https://wa.me/+923030126345">
                <img src="{{ asset('assets/website/images/whatsapp.png') }}" alt="">
            </a>
        </div>
        <!-- /Scroll To Up Button -->

        <!-- Footer -->
        @include('website.layouts.partials.footer')
        <!-- /Footer -->

        @include('website.layouts.partials.modals')

    <!-- /Layout Wrapper -->
    <!-- Scripts -->
    @include('website.layouts.partials.scripts')

</body>
</html>
