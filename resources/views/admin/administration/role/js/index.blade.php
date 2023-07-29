@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            const RoleDataTable = $('#roleTable').DataTable({
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                ajax: "{{ route('admin.role.index') }}",
                columns: [{
                        "data": "Row_Index_ID"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "status_label"
                    },
                    {
                        "mRender": function(data, type, row) {
                            let html = `
                        <input type="hidden" name="id" value="${row.id}">
                        <input type="hidden" name="name" value="${row.name}">
                        <input type="hidden" name="status" value="${row.status}">
                        <a type="button" data-id="${row.id}" class="edit text-success me-2" style="cursor:pointer"><i class="bx bx-edit-alt "></i>Edit</a>
                        <a class="delete text-danger" data-id="${row.id}" style="cursor:pointer"><i class="bx bx-trash"></i>Delete</a>
                        `
                            return html;
                        }
                    }
                ]
            });

            /*Open Modal*/
            $('#openRoleModal').click(function() {
                $('#createRoleModal').modal('show');
            });

            /*Storing Create Role Form*/
            $('#createRoleForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'The name field is required.'
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.role.store') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#createRoleForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#createRoleForm .btn-primary', false,
                                'Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#createRoleForm')[0].reset();
                                $('#createRoleModal').modal('hide');
                                RoleDataTable.ajax.reload();
                                sweetAlertMessage('success', res.response);
                            } else if (res.success == false) {
                                if(res.response.name){
                                    sweetAlertMessage('error', res.response.name[0]);
                                }else if(res.response.slug){
                                    sweetAlertMessage('error', res.response.slug[0]);
                                }
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            /**Opening Edit Modal*/
            let id;
            $('body').delegate('.edit', 'click', function() {
                id = $(this).attr('data-id');
                const name = $(this).parent().find('input[name="name"]').val();
                const status = $(this).parent().find('input[name="status"]').val();

                $('#updateRoleForm input[name="id"]').val(id);
                $('#updateRoleForm input[name="name"]').val(name);
                $('#updateRoleForm select[name="status"]').val(status);
                $('#updateRoleModal').modal('show');
            });


            /*Storing Create Role Form*/
            $('#updateRoleForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'The name field is required.'
                    },
                },
                submitHandler: function(form) {
                    const route = "{{ route('admin.role.update', ':id') }}";
                    const url = route.replace(':id', id);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#updateRoleForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#updateRoleForm .btn-primary', false,
                                'Update & Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#updateRoleForm')[0].reset();
                                $('#updateRoleModal').modal('hide');
                                RoleDataTable.ajax.reload();
                                sweetAlertMessage('success', res.response);
                            } else if (res.success == false) {
                                if(res.response.name){
                                    sweetAlertMessage('error', res.response.name[0]);
                                }else if(res.response.slug){
                                    sweetAlertMessage('error', res.response.slug[0]);
                                }
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
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
                            let url = "{{ route('admin.role.destroy', ':id') }}";
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
