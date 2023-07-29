@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            const CategoryDataTable = $('#categoryTable').DataTable();

        });
    </script>
@endpush
