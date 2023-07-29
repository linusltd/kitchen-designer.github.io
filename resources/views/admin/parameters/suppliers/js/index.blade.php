@push('scripts')
    <script>
        $(document).ready(function(){
            @include('admin.common.jshelper');

            /*Get All Suppliers*/
            const SupplierDataTable = $('#SupplierTable').DataTable({
            responsive: false,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            lengthMenu: [[10, 25, 30, 50, -1], [10, 25, 30, 50, "All"]],
            pageLength: 30,
            ajax: "{{ route('admin.suppliers.index') }}",
            columns: [
                { "data": "Row_Index_ID" },
                { "data": "name" },
                { "data": "contact_person" },
                { "data": "mobile" },
                { "data": "city" },
                { "data": "opening_date" },
                { "data": "status" },
                {"mRender": function ( data, type, row ) {
                        const route = "{{ route('admin.suppliers.edit', ':id') }}";
                        const url = route.replace(':id', row.id);
                        let html = `
                        <a href="${url}"  class="edit text-success me-2" style="cursor:pointer"><i class="bx bx-edit-alt "></i>Edit</a>
                        <a class="delete text-danger" data-id="${row.id}" style="cursor:pointer"><i class="bx bx-trash"></i>Delete</a>
                        `
                        return html;
                    }
                }
            ]
            });



        });
    </script>
@endpush
