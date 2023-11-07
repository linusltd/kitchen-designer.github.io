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
            const order_items = @json($order->order_items);

            const orderIds = order_items.length > 0 ? order_items.map(item => item.book_id) : [];
            let bookIds = orderIds;
            let i = 1;
            /*Load Book For Purchase*/
            calculateTotalPrice();
            $('body').delegate('#loadBookBtn', 'click', function() {
                const id = $(this).attr('data-id');
                const name = $(this).parent().find('input[name="name"]').val();
                const sku = $(this).parent().find('input[name="sku"]').val();
                const price = $(this).parent().find('input[name="price"]').val();
                if (!bookIds.includes(parseInt(id))) {
                    bookIds.push(parseInt(id));
                    let html = `
                        <tr>
                            <td>${i}</td>
                            <td>${name}
                                <input type="hidden" name="product_name[]" placeholder="Product Name" value="${name}" />
                            </td>
                            <td>
                            <input type="hidden" name="book_id[]" value="${id}"/>
                            <input type="number" style="width:80%;height:35px" name="price[]" id="price" value="${price}" class="disabled" readonly/></td>
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

            $('body').delegate('#addNonSystemProduct', 'click', function() {
                let html = `<tr>
                                <td>${i}</td>
                                <td>
                                    <input type="text" name="product_name[]" placeholder="Product Name" />
                                </td>
                                <td>
                                    <input type="hidden" name="book_id[]" value=""/>
                                    <input type="number" style="width:80%;height:35px" name="price[]"
                                            id="price" class="disabled" />
                                </td>
                                <td>
                                    <input type="number" style="width:80%;height:35px"
                                            name="discount_percentrage[]" id="discount_percentrage"
                                            value="0" />
                                </td>
                                <td>
                                    <input type="number" style="width:80%;height:35px" name="qty[]" id="qty" value="0"/>
                                </td>
                                <td>
                                    <input type="number" style="width:80%;height:35px;margin-right:10px"
                                        name="total_amount[]" id="total_amount" value="0"
                                        class="disabled" readonly />
                                        <i class="fas fa-trash text-danger cursor-pointer" id="deleteOrderRow"
                                                ></i>
                                </td>
                            </tr>`;
                i++;

                $('#loadPurchaseItems').append(html)
                calculateTotalPrice();
            })


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
                if (discount_percentrage != "") {
                    const discount_value = Math.round(price * `.${discount_percentrage}`);
                    if (discount_value !== 'NAN') {
                        $(this).parent().parent().find('#discount_value').val(discount_value);
                    }
                } else {
                    $(this).parent().parent().find('#discount_value').val(0);
                }

            });

            /*Caculating Values*/
            $('body').delegate('#qty', 'keyup', function() {
                const qty = $(this).val();
                const price = $(this).parent().parent().find('#price').val();
                const discount_value = $(this).parent().parent().find('#discount_value').val();
                const discount_percentrage = $(this).parent().parent().find('#discount_percentrage').val();

                if (qty != "" && discount_percentrage != "") {
                    // const total_amount = Math.round((price * `.${100 - discount_percentrage}`) * qty);
                    const total_amount = (discount_percentrage > 0 ? (discount_percentrage / 100) : 1) *
                        price * qty;
                    if (total_amount !== 'NAN') {
                        $(this).parent().parent().find('#total_amount').val(total_amount);
                        calculateTotalQty();
                        calculateTotalAmount();
                    }
                } else {
                    $(this).parent().parent().find('#discount_total').val(0);
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
                        url: "{{ route('admin.sales-order.update', $order->id) }}",
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
                                        "{{ route('admin.sales-order.index') }}";
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
