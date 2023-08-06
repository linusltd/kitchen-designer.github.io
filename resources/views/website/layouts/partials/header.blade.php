<!-- Styles -->
<link rel="stylesheet" href="{{ asset('assets/website/css/normzalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/shop.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/product.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/cart.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/order.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/404.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('assets/website/css/media.css') }}">

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<!-- Toaster CSS & JS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .whatsapp-btn{
        position: fixed;
        bottom: 70px;
        right: 20px;
        z-index: 100;
    }
    .whatsapp-btn img{
        width: 70px;
        height: 70px;
    }

</style>

@stack('styles')
