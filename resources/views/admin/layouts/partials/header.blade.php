<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/admin') }}/img/favicon/favicon.ico" />
<!-- Page -->
<link rel="stylesheet" href="{{ asset('assets/admin') }}/vendor/css/pages/page-auth.css" />
<!-- Helpers -->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
/>

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="{{ asset('assets/admin') }}/vendor/fonts/boxicons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin') }}/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/admin') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/admin') }}/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

<link rel="stylesheet" href="{{ asset('assets/admin') }}/vendor/libs/apex-charts/apex-charts.css" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="{{ asset('assets/admin') }}/vendor/js/helpers.js"></script>

<!-- jQuery Uploader Files -->

<link rel="stylesheet" href="{{ asset('assets/admin/libs/ajax-file-uploader/css/jquery.uploader.css') }}">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/admin') }}/js/config.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js" integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Multiselect -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" integrity="sha512-72McA95q/YhjwmWFMGe8RI3aZIMCTJWPBbV8iQY3jy1z9+bi6+jHnERuNrDPo/WGYEzzNs4WdHNyyEr/yXJ9pA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Datables CDN --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/super-build/ckeditor.js"></script>


@stack('styles')
<style>
    .input-group-merge{
        position: relative;
    }
    .is-invalid{
        color: red;
        display: block;
    }
    .jquery-uploader{
        border: 1px dotted;
    }
    span{
        font-size: 13px;
    }
    .title-wrapper{
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 1rem
    }
    .image-wrapper{
        width: 100px;
        height: 100px;
    }
    .image-wrapper img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .book-name{
        word-wrap: break-word;
    }


</style>
