@push('scripts')
    <script>
        $(document).ready(function(){
            $('#loginForm').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                rules:{
                    email:{
                        required:true,
                    },
                    password:{
                        required:true,
                    }
                },
                messages:{
                    email:{
                        required:'The email field is required.'
                    },
                    password:{
                        required:'The password field is required.'
                    },
                }
            });
        });
    </script>
@endpush
