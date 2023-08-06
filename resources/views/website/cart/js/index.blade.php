@push('scripts')
    <script>
        $(document).ready(function(){
            @include('website.common.jsHelper')

            /*Clear Cart Items*/
            $('#clearCart').click(function(){
                $.ajax({
                    url:"{{ route('website.cart.clear.cart') }}",
                    method:"GET",
                    success:function(response){
                        window.location.reload();
                    }
                })
            })

            /*Get Cart Items*/
            function getCartItemsDetails(){
                $.ajax({
                    url:"{{ route('website.cart.details') }}",
                    method:"GET",
                    success:function(response){
                        $('#cart__body').html(response.cartItems)
                        $('#cartItemsBillBody').html(response.cartBill)
                    },error:function(xhr){
                        console.log(xhr.responseText)
                    }
                })
            }

            /*Delete Item From Cart*/
            $('body').delegate('#deleteCartItem', 'click', function(){
                const id = $(this).attr('data-id')

                $.ajax({
                    url:"{{ route('website.cart.delete.from.cart') }}",
                    method:"GET",
                    data:{id},
                    success:function(response){
                        if(response.success == false){
                            window.location.reload();
                        }
                        getCartCount();
                        getCartTotal();
                        getCartItemsDetails();

                    },error:function(xhr){
                        console.log(xhr.responseText)
                    }
                })


            });

            /*Add Item To Cart*/
            $('body').delegate('#addToCartInternalBtn', 'click', function(){
                const book_id = $(this).attr('data-id')
                $.ajax({
                    url:"{{ route('website.cart.add.to.cart') }}",
                    method:"POST",
                    data:{book_id, _token:"{{ csrf_token() }}"},
                    success:function(response){
                        getCartCount();
                        getCartTotal();
                        getCartItemsDetails();
                    },
                    error:function(xhr){
                        console.log(xhr.responseText)
                    }
                })

            });

            /*Remove Item To Cart*/
            $('body').delegate('#removeFromCartInternalBtn', 'click', function(){
                const id = $(this).attr('data-id')
                $.ajax({
                    url:"{{ route('website.cart.remove.from.cart') }}",
                    method:"POST",
                    data:{id, _token:"{{ csrf_token() }}"},
                    success:function(response){
                        if(response.success == false){
                            window.location.reload();
                        }
                        getCartCount();
                        getCartTotal();
                        getCartItemsDetails();
                    },
                    error:function(xhr){
                        console.log(xhr.responseText)
                    }
                })

            });

            $('#createOrderForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules: {
                    fname: {
                        required: true,
                    },
                    lname: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    zip: {
                        required: true,
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    fname: {
                        required: 'Billing First Name is a required field.'
                    },
                    lname: {
                        required: 'Billing Last Name is a required field.'
                    },
                    address: {
                        required: 'Billing Complete Address is a required field.'
                    },
                    state: {
                        required: 'Please select a state.'
                    },
                    city: {
                        required: 'Billing Town / City is a required field.'
                    },
                    zip: {
                        required: 'Billing Postcode / ZIP is a required field..'
                    },
                    phone: {
                        required: 'Billing Phone is a required field.'
                    },
                    email: {
                        required: 'Billing Email address is a required field.'
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('website.order.create-order') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            $('.place__order-btn').html(`<i class="fas fa-spinner fa-spin spinner"></i>`)
                            $('.place__order-btn').attr('disabled', true)
                        },
                        complete: function() {
                            $('.place__order-btn').html(`Place Order`)
                            $('.place__order-btn').removeAttr('disabled')
                        },
                        success: function(response) {
                            if(response.status == false){
                                $('input[name="email"]').focus()
                                return alert('Your email address is not valid. Please use a valid email address');

                            }
                            window.location = response;
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

        })
    </script>
@endpush
