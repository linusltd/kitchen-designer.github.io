@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            const CategoryDataTable = $('#categoryTable').DataTable({
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                lengthMenu: [[10, 25, 30, 50, -1], [10, 25, 30, 50, "All"]],
                pageLength: 30,
                ajax: "{{ route('admin.categories.index') }}",
                columns: [{
                        "data": "Row_Index_ID"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "slug"
                    },
                    {
                        "data": "show_top_label"
                    },
                    {
                        "data": "status_label"
                    },
                    {
                        "mRender": function(data, type, row) {
                            let html = `
                        <input type="hidden" name="name" value="${row.name}">
                        <input type="hidden" name="slug" value="${row.slug}">
                        <input type="hidden" name="image" value="${row.image}">
                        <input type="hidden" name="color" value="${row.color}">
                        <input type="hidden" name="parent_id" value="${row.parent_id}">
                        <input type="hidden" name="status" value="${row.status}">
                        <input type="hidden" name="show_top" value="${row.show_top}">
                        <input type="hidden" name="level" value="${row.level}">
                        <a type="button" data-id="${row.id}" class="edit text-success me-2" style="cursor:pointer"><i class="bx bx-edit-alt "></i>Edit</a>
                        <a class="delete text-danger" data-id="${row.id}" style="cursor:pointer"><i class="bx bx-trash"></i>Delete</a>
                        `
                            return html;
                        }
                    }
                ]
            });

            /*Open Modal*/
            $('#openCreateCategorModal').click(function() {
                $('#createCategoryModal').modal('show');
            });

             /*Creating Slug*/
             $('#createCategoryForm input[name="name"]').keyup(function() {
                const val = $(this).val().toLowerCase();
                const slug = $('#createCategoryForm input[name="slug"]').val(
                    `${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
            });

             /*Creating Slug*/
             $('#updateCategoryForm input[name="name"]').keyup(function() {
                const val = $(this).val().toLowerCase();
                const slug = $('#updateCategoryForm input[name="slug"]').val(
                    `${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
            });

            /*Loading Image Prview*/
            $('#createCategoryForm #image').change(function(){
                readURL(this, '#createCategoryForm #preview_image');
            })

            $('#updateCategoryForm #image').change(function(){
                readURL(this, '#updateCategoryForm #preview_image');
            })



            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(previewId).css('background-image', 'url('+e.target.result +')');
                        $(previewId).hide();
                        $(previewId).fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            /*Storing Create Category Form*/
            $('#createCategoryForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    name: {
                        required: true,
                    },
                    slug: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'The name field is required.'
                    },
                    slug: {
                        required: 'The slug field is required.'
                    },
                },
                submitHandler: function(form) {
                    const formData = new FormData(form)
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.categories.store') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            btnDisableHandler('#createCategoryForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#createCategoryForm .btn-primary', false,
                                'Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#createCategoryForm')[0].reset();
                                $('#createCategoryModal').modal('hide');
                                CategoryDataTable.ajax.reload();
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
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
                const slug = $(this).parent().find('input[name="slug"]').val();
                const parent_id = $(this).parent().find('input[name="parent_id"]').val();
                const status = $(this).parent().find('input[name="status"]').val();
                const show_top = $(this).parent().find('input[name="show_top"]').val();
                const color = $(this).parent().find('input[name="color"]').val();
                const image = $(this).parent().find('input[name="image"]').val();

                $('#updateCategoryForm input[name="id"]').val(id);
                $('#updateCategoryForm input[name="name"]').val(name);
                $('#updateCategoryForm input[name="slug"]').val(slug);
                $('#updateCategoryForm input[name="color"]').val(color);
                $('#updateCategoryForm select[name="parent_id"]').val(parent_id);
                $('#updateCategoryForm select[name="show_top"]').val(show_top);
                $('#updateCategoryForm select[name="status"]').val(status);
                $('#updateCategoryForm #preview_image').attr('src', image);
                $('#updateCategoryModal').modal('show');
            });


            /*Storing Create Category Form*/
            $('#updateCategoryForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    name: {
                        required: true,
                    },
                    slug: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'The name field is required.'
                    },
                    slug: {
                        required: 'The slug field is required.'
                    },
                },
                submitHandler: function(form) {
                    const route = "{{ route('admin.categories.update', ':id') }}";
                    const url = route.replace(':id', id);
                    const formData = new FormData(form)
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            btnDisableHandler('#updateCategoryForm .btn-primary', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#updateCategoryForm .btn-primary', false,
                                'Update & Save Changes');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                $('#updateCategoryForm')[0].reset();
                                $('#updateCategoryModal').modal('hide');
                                CategoryDataTable.ajax.reload();
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
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


            /*Deleting Category*/
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
                            let url = "{{ route('admin.categories.destroy', ':id') }}";
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
                                        CategoryDataTable.ajax.reload();
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
