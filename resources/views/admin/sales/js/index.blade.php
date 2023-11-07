@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            /*Get All Suppliers*/
            const PurchaseDataTable = $('#salesOrderTable').DataTable({
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                ajax: "{{ route('admin.sales-order.index') }}",
                columns: [{
                        "data": "Row_Index_ID"
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "order_no"
                    },
                    {
                        "data": "supplier"
                    },
                    {
                        "data": "delivery"
                    },
                    {
                        "data": "qty"
                    },
                    {
                        "data": "total_amount"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "mRender": function(data, type, row) {
                            const route = "{{ route('admin.sales-order.edit', ':id') }}";
                            const url = route.replace(':id', row.id);
                            const showRoute = "{{ route('admin.sales-order.show', ':id') }}";
                            const showUrl = showRoute.replace(':id', row.id);
                            let html = `
                        <a href="${url}"  class="edit text-success me-2" style="cursor:pointer"><i class="bx bx-edit-alt "></i>Edit</a>
                        <a href="${showUrl}" target="_blank"  class="edit text-primary me-2" style="cursor:pointer"><i class="bx bx-pdf "></i>View</a>
                        `;
                            return html;
                        }
                    }
                ]
            });



        });
    </script>
@endpush
