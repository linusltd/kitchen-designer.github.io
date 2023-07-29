@push('scripts')
    <script>
        $(document).ready(function(){
            @include('admin.common.jshelper');

            /*Multiselect*/
            $('select[name="city"]').select2({
                placeholder:'--select city--'
            });
            /*Multiselect*/
            $('select[name="status"]').select2({
            });

            /*Storing Suppliers Form*/
            $('form').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules:{
                    name:{
                        required:true,
                        minlength:3
                    },
                    contact_person:{
                        required:true,
                        minlength:3
                    },
                    mobile:{
                        required:true,
                        minlength:13,
                        maxlength:13
                    },
                    opening_date:{
                        required:true
                    },
                    address:{
                        required:true,
                        minlength:10
                    },
                    city:{
                        required:true,
                    },
                },
                messages:{
                    name:{
                        required:'The name field is required.'
                    },
                    contact_person:{
                        required:'The contact person field is required.'
                    },
                    mobile:{
                        required:'The mobile field is required.'
                    },
                    opening_date:{
                        required:'The opening date field is required.'
                    },
                    address:{
                        required:'The address field is required.'
                    },
                    city:{
                        required:'Please select a city'
                    },
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.suppliers.update', $supplier->id) }}",
                        data: $(form).serialize(),
                        beforeSend:function(){
                            btnDisableHandler('#createPublisherForm .btn-primary', true, 'Processing...');
                        },
                        complete:function(){
                            btnDisableHandler('#createPublisherForm .btn-primary', false, 'Save Changes');
                        },
                        success: function(res) {
                            if(res.success == true){
                                $('form')[0].reset();
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location = "{{ route('admin.suppliers.index') }}";
                                }, 1000);
                            }else if(res.success == false){
                                sweetAlertMessage('error', res.response.name[0]);
                            }
                        },error:function(xhr){
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

        });
    </script>
@endpush
