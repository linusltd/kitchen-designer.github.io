@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            /*Storing Payment Voucher*/
            $('#makePaymentEntryForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    account_id: {
                        required: true
                    },
                    from: {
                        required: true
                    },
                    to: {
                        required: true
                    },
                },
                messages: {},
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('admin.ledger.index') }}",
                        method: "GET",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('#savePayementVoucherForm .btn-primary', true,
                                '<i class="fas fa-search"></i>');
                        },
                        complete: function() {
                            btnDisableHandler('#savePayementVoucherForm .btn-primary',
                                false,
                                '<i class="fas fa-search"></i>');
                        },
                        success: function(res) {
                            $('#tbody').html(res);
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
