@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper');

            const accounts = @json($accounts)
            /*Storing Payment Voucher*/
            $('#savePayementVoucherForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {},
                messages: {},
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('admin.cash-payment-voucher.store') }}",
                        method: "POST",
                        data: $(form).serialize(),
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
                                    window.location.reload();
                                }, 1000);
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
            /*Storing Create Category Form*/
            var id = 1;
            $('#makePaymentEntryForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    account_id: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    amount: {
                        required: true,
                    },
                    narration: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    account_id: {
                        required: 'Please select an account.'
                    },
                    date: {
                        required: 'Please select a date.'
                    },
                    amount: {
                        required: 'The amount field is required.'
                    },
                    narration: {
                        required: 'The narration field is required.'
                    },
                },
                submitHandler: function(form) {
                    const account_id = $('#makePaymentEntryForm select[name="account_id"]').val();
                    const account_text = $(
                            '#makePaymentEntryForm select[name="account_id"] option:selected')
                        .text();
                    const date = $('#makePaymentEntryForm input[name="date"]').val();
                    const amount = $('#makePaymentEntryForm input[name="amount"]').val();
                    const narration = $('#makePaymentEntryForm input[name="narration"]').val();
                    const bill_no = $('#makePaymentEntryForm input[name="bill_no"]').val();
                    const account = accounts.find(ac => ac.id == account_id)
                    const html = `
                    <tr id="row_${id}">
                        <td>${id}</td>
                        <td>${account.account_id}</td>
                        <td>${account_text}</td>
                        <td>${date}</td>
                        <td>${amount}</td>
                        <td>${narration}</td>
                        <td>${bill_no}</td>
                        <td>
                            <i class="fas fa-edit text-primary cursor-pointer" data-id="${id}" id="editEntry"></i>
                            <i class="fas fa-trash text-danger cursor-pointer" data-id="${id}" id="deleteEntry"></i>
                        </td>
                        <input type="hidden" name="account_ids[]" id="account_ids" value="${account_id}"/>
                        <input type="hidden" name="dates[]" id="dates" value="${date}"/>
                        <input type="hidden" name="amounts[]" id="amounts" value="${amount}"/>
                        <input type="hidden" name="narrations[]" id="narrations" value="${narration}"/>
                        <input type="hidden" name="bill_nos[]" id="bill_nos" value="${bill_no}"/>
                    </tr>
                    `;
                    id++;
                    $(`#tbody`).append(html);
                    calculateTotalAmount();
                    $('#makePaymentEntryForm')[0].reset();
                    $('#makePaymentEntryForm input[name="date"]').val(date)
                }
            });

            $('#updatePaymentEntryForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    account_id: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    amount: {
                        required: true,
                    },
                    narration: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    account_id: {
                        required: 'Please select an account.'
                    },
                    date: {
                        required: 'Please select a date.'
                    },
                    amount: {
                        required: 'The amount field is required.'
                    },
                    narration: {
                        required: 'The narration field is required.'
                    },
                },
                submitHandler: function(form) {
                    const id = $('#updatePaymentEntryForm input[name="id"]').val();
                    const account_id = $('#updatePaymentEntryForm select[name="account_id"]').val();
                    const account_text = $(
                            '#updatePaymentEntryForm select[name="account_id"] option:selected')
                        .text();
                    const date = $('#updatePaymentEntryForm input[name="date"]').val();
                    const amount = $('#updatePaymentEntryForm input[name="amount"]').val();
                    const narration = $('#updatePaymentEntryForm input[name="narration"]').val();
                    const bill_no = $('#updatePaymentEntryForm input[name="bill_no"]').val();
                    const account = accounts.find(ac => ac.id == account_id)

                    const html = `
                    <td>${id}</td>
                        <td>${account.account_id}</td>
                        <td>${account_text}</td>
                        <td>${date}</td>
                        <td>${amount}</td>
                        <td>${narration}</td>
                        <td>${bill_no}</td>
                        <td>
                            <i class="fas fa-edit text-primary cursor-pointer" data-id="${id}" id="editEntry"></i>
                            <i class="fas fa-trash text-danger cursor-pointer" data-id="${id}" id="deleteEntry"></i>
                        </td>
                        <input type="hidden" name="account_ids[]" id="account_ids" value="${account_id}"/>
                        <input type="hidden" name="dates[]" id="dates" value="${date}"/>
                        <input type="hidden" name="amounts[]" id="amounts" value="${amount}"/>
                        <input type="hidden" name="narrations[]" id="narrations" value="${narration}"/>
                        <input type="hidden" name="bill_nos[]" id="bill_nos" value="${bill_no}"/>
                    `;
                    $(`#row_${id}`).html(html);
                    $('#makePaymentEntryForm').removeClass('d-none')
                    $('#updatePaymentEntryForm').addClass('d-none')
                    calculateTotalAmount();
                    $('#updatePaymentEntryForm')[0].reset();
                }
            });


            /*Cancel Editing Voucher*/
            $('#cancelBtn').click(function() {
                $('#makePaymentEntryForm').removeClass('d-none')
                $('#updatePaymentEntryForm').addClass('d-none')
            });

            /*Deleting Entry*/
            $('body').delegate('#deleteEntry', 'click', function() {
                const id = $(this).attr('data-id');
                $(`#row_${id}`).remove();
                calculateTotalAmount();
            });

            /*Edit Bill Payment Entery*/
            $('body').delegate('#editEntry', 'click', function() {
                const id = $(this).attr('data-id');
                const account_id = $(this).parent().parent().find('#account_ids').val();
                const date = $(this).parent().parent().find('#dates').val();
                const amount = $(this).parent().parent().find('#amounts').val();
                const narration = $(this).parent().parent().find('#narrations').val();
                const bill_no = $(this).parent().parent().find('#bill_nos').val();

                $('#makePaymentEntryForm').addClass('d-none')
                $('#updatePaymentEntryForm').removeClass('d-none')
                $('#updatePaymentEntryForm input[name="id"]').val(id);
                $('#updatePaymentEntryForm select[name="account_id"]').val(account_id);
                $('#updatePaymentEntryForm input[name="date"]').val(date);
                $('#updatePaymentEntryForm input[name="amount"]').val(amount);
                $('#updatePaymentEntryForm input[name="narration"]').val(narration);
                $('#updatePaymentEntryForm input[name="bill_no"]').val(bill_no);
            });

            /*Totaling All Amounts*/
            function calculateTotalAmount() {
                let total_amount = 0;

                $('input[name="amounts[]"]').each(function() {
                    total_amount += parseInt($(this).val());

                });
                if (total_amount > 0) {
                    $('#tfoot').removeClass('d-none')
                    $('#savePaymentVoucher').removeClass('d-none')
                    $('#total').html(total_amount);
                    $('#savePayementVoucherForm input[name="amount"]').val(total_amount);
                } else {
                    $('#tfoot').addClass('d-none')
                    $('#savePaymentVoucher').addClass('d-none')
                }

            }
        });
    </script>
@endpush
