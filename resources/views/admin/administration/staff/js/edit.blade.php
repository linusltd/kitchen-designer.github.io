@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            /*Storing Payment Voucher*/
            $('#savePayementVoucherForm').validate({
                    errorClass: "is-invalid",
                    validClass: "is-valid",
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email:true
                        },
                        role_id: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: 'The name field is required.'
                        },
                        email: {
                            required: 'The email field is required.'
                        },
                        role_id: {
                            required: 'Please select a role.'
                        },
                    },
                submitHandler: function(form) {
                    const formData = new FormData(form)
                    $.ajax({
                        url: "{{ route('admin.staff.update', $staff->id) }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            btnDisableHandler('#savePayementVoucherForm .btn-success', true,
                                'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('#savePayementVoucherForm .btn-success',
                                false,
                                'Save');
                        },
                        success: function(res) {
                            if (res.success == true) {
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location = "{{ route('admin.staff.index') }}";
                                }, 1000);
                            } else if (res.success == false) {
                                sweetAlertMessage('error', res.response.email[0]);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

        });
    </script>
@endpush
