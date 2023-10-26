@push('scripts')
    <script>
        $(document).ready(function() {
            @include('website.common.jsHelper')
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
                        url: "{{ route('website.profile.update-address') }}",
                        data: $(form).serialize(),
                        beforeSend: function() {
                            $('.place__order-btn').html(
                                `<i class="fas fa-spinner fa-spin spinner"></i>`)
                            $('.place__order-btn').attr('disabled', true)
                        },
                        complete: function() {
                            $('.place__order-btn').html(`Place Order`)
                            $('.place__order-btn').removeAttr('disabled')
                        },
                        success: function(response) {
                            alert('address updated successfully!')
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
