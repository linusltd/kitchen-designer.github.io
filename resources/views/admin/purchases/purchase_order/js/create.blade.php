@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper')

            $('#OpenLoadProductsModel').click(function() {
                $('#loadProductsModal').modal('show');
                getProducts('');
            });

            $('#search').keyup(function() {
                getProducts($(this).val());
            });

            /*Function Get Products*/
            function getProducts(name) {
                $.ajax({
                    url: "{{ route('admin.purchase-order.get-books') }}",
                    method: "GET",
                    data: {
                        name
                    },
                    success: function(res) {
                        $('#loadProductsBody').html(res);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            let bookIds = [];
            let i = 1;
            /*Load Book For Purchase*/
            $('body').delegate('#loadBookBtn', 'click', function() {
                const id = $(this).attr('data-id');
                const name = $(this).parent().find('input[name="name"]').val();
                const sku = $(this).parent().find('input[name="sku"]').val();
                const price = $(this).parent().find('input[name="price"]').val();
                if (!bookIds.includes(id)) {
                    bookIds.push(id);

                    let html = `
                        <tr>
                            <td>${i}</td>
                            <td>${name}</td>
                            <td>${sku}</td>
                            <td>
                            <input type="hidden" name="book_id[]" value="${id}"/>
                            <input type="number" style="width:80%;height:35px" name="price[]" id="price" value="${price}" class="disabled"/></td>
                            <td><input type="number" style="width:80%;height:35px" name="discount_percentrage[]" id="discount_percentrage" value="0"/></td>
                            <td><input type="number" style="width:80%;height:35px" name="qty[]" id="qty" value="0"/></td>
                            <td><input type="number" style="width:80%;height:35px;margin-right:10px" name="total_amount[]" id="total_amount" value="0" class="disabled" readonly/>
                            <i class="fas fa-trash text-danger cursor-pointer" id="deleteOrderRow" data-id="${id}"></i>
                            </td>
                        </tr>
                    `;
                    i++;

                    $('#loadPurchaseItems').append(html);
                    calculateTotalPrice();
                }

            });

            $('body').delegate('#deleteOrderRow', 'click', function() {
                const id = $(this).attr('data-id');

                bookIds = bookIds.filter(bookId => bookId != id);
                $(this).parent().parent().remove();

                calculateTotalQty();
                calculateTotalAmount();


            });

            /*Caculating Values*/
            $('body').delegate('#discount_percentrage', 'keyup', function() {
                const discount_percentrage = $(this).val();
                const price = $(this).parent().parent().find('#price').val();
                const qty = $(this).parent().parent().find('#qty').val();
                if (discount_percentrage != "" || discount_percentrage > 0) {
                    const total_amount = (discount_percentrage > 0 ? (discount_percentrage / 100) : 1) * price * qty;
                    if (total_amount !== 'NAN') {
                        $(this).parent().parent().find('#total_amount').val(total_amount);
                    }
                } else {
                    $(this).parent().parent().find('#total_amount').val(0);
                }

            });

            /*Caculating Values*/
            $('body').delegate('#qty', 'keyup', function() {
                const qty = $(this).val();
                const price = $(this).parent().parent().find('#price').val();
                const discount_percentrage = $(this).parent().parent().find('#discount_percentrage').val();

                if (qty != "" && discount_percentrage != "") {
                    const total_amount = (discount_percentrage > 0 ? (discount_percentrage / 100) : 1) * price * qty;
                    console.log(total_amount)
                    if (total_amount !== 'NAN') {
                        $(this).parent().parent().find('#total_amount').val(total_amount);
                        calculateTotalQty();
                        calculateTotalAmount();
                    }
                } else {
                    $(this).parent().parent().find('#total_amount').val(0);
                }

            });

            /*Calculating Total Discount Value*/
            function calculateTotalQty() {
                let total_qty = 0;

                $('input[name="qty[]"]').each(function() {
                    total_qty += parseInt($(this).val());
                });

                $('#totalQty').html(total_qty);
                $('input[name="total_qty"]').val(total_qty);
            }

            /*Calculating Total Amount Value*/
            function calculateTotalAmount() {
                let total_amount = 0;

                $('input[name="total_amount[]"]').each(function() {
                    total_amount += parseInt($(this).val());
                });

                $('#totalAmount').html(total_amount);
                $('input[name="total_order_amount"]').val(total_amount);
            }

            /*Calculating Total Price Value*/
            function calculateTotalPrice() {
                let total_price = 0;

                $('input[name="price[]"]').each(function() {
                    total_price += parseInt($(this).val());
                });

                $('#totalPrice').html(total_price);
            }


            /*Storing Suppliers Form*/
            $('form').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    supplier_id: {
                        required: true,
                    },
                    issue_date: {
                        required: true,
                    },
                    delivery_date: {
                        required: true,
                    },
                },
                messages: {
                    supplier_id: {
                        required: 'Please select a supplier.'
                    },
                    issue_date: {
                        required: 'Please select issue date.'
                    },
                    delivery_date: {
                        required: 'Please select delivery date.'
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.purchase-order.store') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            btnDisableHandler('.btn-primary', true, 'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler('.btn-primary', false, 'Save Changes');
                        },
                        success: function(res) {
                            if (res.success == true) {
                                $('form')[0].reset();
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location =
                                        "{{ route('admin.purchase-order.index') }}";
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

        });
    </script>
@endpush
