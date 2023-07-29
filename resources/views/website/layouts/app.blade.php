<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TG4Z8CQDRQ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-TG4Z8CQDRQ');
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
        <div style="margin-top: 113px">
            @yield('content')
        </div>
        <!-- /Content -->

        <!-- Scroll To Up Button -->
        <button id="scrollToTopBtn" title="Go to top">&#8593;</button>
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
