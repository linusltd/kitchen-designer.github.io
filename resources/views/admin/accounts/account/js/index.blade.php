@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            /*Get All Categories*/
            const AccountDataTable = $('#accountTable').DataTable({
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                ajax: "{{ route('admin.account.index') }}",
                columns: [{
                        "data": "Row_Index_ID"
                    },
                    {
                        "data": "account_id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "mRender": function(data, type, row) {
                            let html = `
                        <input type="hidden" name="name" value="${row.name}">
                        <input type="hidden" name="id" value="${row.id}">
                        <a type="button"  class="edit text-success me-2" style="cursor:pointer" data-id="${row.id}"><i class="bx bx-edit-alt " ></i>Edit</a>
                        <a class="delete text-danger" data-id="${row.id}" style="cursor:pointer"><i class="bx bx-trash"></i>Delete</a>
                        `
                            return html;
                        }
                    }
                ]
            });

            /*Open Modal*/
            $('#openCreateCategorModal').click(function() {
                $('#createAccountModal').modal('show');
            });

            /*Storing Create Account Form*/
            $('#createAccountForm').validate({
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
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.account.store') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#createAccountForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#createAccountForm .btn-primary', false,
                                'Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#createAccountForm')[0].reset();
                                $('#createAccountModal').modal('hide');
                                AccountDataTable.ajax.reload();
                                sweetAlertMessage('success', res.response);
                            } else if (res.success == false) {
                                sweetAlertMessage('error', res.response.name[0]);
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

                $('#updateAccountForm input[name="id"]').val(id);
                $('#updateAccountForm input[name="name"]').val(name);
                $('#updateAccountModal').modal('show');
            });


            /*Storing Create Account Form*/
            $('#updateAccountForm').validate({
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
                    const route = "{{ route('admin.account.update', ':id') }}";
                    const url = route.replace(':id', id);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#updateAccountForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#updateAccountForm .btn-primary', false,
                                'Update & Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#updateAccountForm')[0].reset();
                                $('#updateAccountModal').modal('hide');
                                AccountDataTable.ajax.reload();
                                sweetAlertMessage('success', res.response);
                            } else if (res.success == false) {
                                sweetAlertMessage('error', res.response.name[0]);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });


            /*Deleting Account*/
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
                            let url = "{{ route('admin.account.destroy', ':id') }}";
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
                                        AccountDataTable.ajax.reload();
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
