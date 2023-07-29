@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            const AuthorDataTable = $('#authorsTable').DataTable({
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                lengthMenu: [[10, 25, 30, 50, -1], [10, 25, 30, 50, "All"]],
                pageLength: 30,
                ajax: "{{ route('admin.authors.index') }}",
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
            $('#openAuthorModal').click(function() {
                $('#createAuthorModal').modal('show');
            });

            /*Storing Create Author Form*/
            $('#createAuthorForm').validate({
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
                        url: "{{ route('admin.authors.store') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#createAuthorForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#createAuthorForm .btn-primary', false,
                                'Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#createAuthorForm')[0].reset();
                                $('#createAuthorModal').modal('hide');
                                AuthorDataTable.ajax.reload();
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

                $('#updateAuthorForm input[name="id"]').val(id);
                $('#updateAuthorForm input[name="name"]').val(name);
                $('#updateAuthorForm select[name="status"]').val(status);
                $('#updateAuthorModal').modal('show');
            });


            /*Storing Create Author Form*/
            $('#updateAuthorForm').validate({
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
                    const route = "{{ route('admin.authors.update', ':id') }}";
                    const url = route.replace(':id', id);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#updateAuthorForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#updateAuthorForm .btn-primary', false,
                                'Update & Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#updateAuthorForm')[0].reset();
                                $('#updateAuthorModal').modal('hide');
                                AuthorDataTable.ajax.reload();
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


            /*Deleting Author*/
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
                            let url = "{{ route('admin.authors.destroy', ':id') }}";
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
                                        AuthorDataTable.ajax.reload();
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
