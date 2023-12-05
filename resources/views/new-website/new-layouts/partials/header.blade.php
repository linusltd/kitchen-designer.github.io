<link rel="shortcut icon" href="{{ asset('new-assets/website/img/favicon.ico') }}" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,900" rel="stylesheet">
<link href="{{ asset('new-assets/website/css/vendor.css') }}" rel="stylesheet">
<link href="{{ asset('new-assets/website/css/style.css') }}" rel="stylesheet">

@stack('styles')
<style>
    .logo {
        width: 106px;
        height: 45px;
    }

    .logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .is-invalid {
        color: red !important;
    }

    .disabled {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .whatsapp-btn {
        position: fixed;
        bottom: 70px;
        right: 20px;
        z-index: 100;
    }

    .whatsapp-btn img {
        width: 50px;
        height: 50px;
    }
</style>
