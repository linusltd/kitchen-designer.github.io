<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/admin') }}/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('assets/admin') }}/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('assets/admin') }}/vendor/js/bootstrap.js"></script>
<script src="{{ asset('assets/admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{ asset('assets/admin') }}/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/admin') }}/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{ asset('assets/admin') }}/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('assets/admin') }}/js/dashboards-analytics.js"></script>

<!-- Page JS -->
<script src="{{ asset('assets/admin') }}/js/ui-popover.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- sweet alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery validation library -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="{{ asset('assets/admin/libs/ajax-file-uploader/dist/jquery.uploader.min.js') }}"></script>

<!-- CK Editor -->
{{-- <script src="{{ asset('assets/admin/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/libs/ckeditor/adapters/jquery.js') }}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

@stack('scripts')

<script>
    $(document).ready(function() {

        $('#pritnShippingLabels').click(function(){
            let orderIds = $('.check-row:checked').map(function() {
                return $(this).val();
            }).get();

            if(orderIds.length == 0){
                return alert('Please select items for print')
            }

            const route = "{{ route('admin.order.print-shipping-label', ':orderIds') }}";
            const url = route.replace(':orderIds', orderIds.toString())
            var newTab = window.open();
            newTab.location.href = url
        });

        $('.check-all').on('click', function() {
            const isChecked = $(this).prop('checked');
            $('.check-row').prop('checked', isChecked);
        });

        $('body').delegate(".toggle-button", "click", function() {
            const orderId = $(this).attr('data-id');

            $('body').find(`.nested-table-${orderId}`).toggle();
        });

        $('#mySelect').change(function() {
            $('#myForm').submit();
        });



    });
</script>
