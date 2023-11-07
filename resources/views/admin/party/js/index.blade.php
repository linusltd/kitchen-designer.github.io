@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            const RoleDataTable = $('#partyTable').DataTable({
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                ajax: "{{ route('admin.party.index') }}",
                columns: [{
                        "data": "Row_Index_ID"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "address"
                    },
                    {
                        "data": "status_label"
                    },
                    {
                        "mRender": function(data, type, row) {
                            const route = "{{ route('admin.party.edit', ':id') }}";
                            const url = route.replace(':id', row.id)
                            let html = `
                        <input type="hidden" name="id" value="${row.id}">
                        <input type="hidden" name="name" value="${row.name}">
                        <input type="hidden" name="status" value="${row.status}">
                        <a href="${url}" class="text-success me-2" style="cursor:pointer"><i class="bx bx-edit-alt "></i>Edit</a>
                        <a class="delete text-danger" data-id="${row.id}" style="cursor:pointer"><i class="bx bx-trash"></i>Delete</a>
                        `
                            return html;
                        }
                    }
                ]
            });

            /*Deleting Role*/
            $('body').delegate('.delete', 'click', function() {
                const id = $(this).attr('data-id');
                Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            let url = "{{ route('admin.party.destroy', ':id') }}";
                            url = url.replace(':id', id);
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    id,
                                    _token: "{{ csrf_token() }}",
                                    _method: "DELETE"
                                },
                                success: function(res) {
                                    if (res.success == true) {
                                        RoleDataTable.ajax.reload();
                                        sweetAlertMessage('success', res.response);
                                    }
                                },
                                error: function(xhr) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    })



            });





        });
    </script>
@endpush
