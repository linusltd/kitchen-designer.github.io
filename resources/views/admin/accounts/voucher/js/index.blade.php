@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');
            $('#categoryTable').DataTable({
                lengthMenu: [[10, 25, 30, 50, -1], [10, 25, 30, 50, "All"]],
                pageLength: 30,
            });
        });

    </script>
@endpush
