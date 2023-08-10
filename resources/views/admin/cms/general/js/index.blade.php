@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper')
            // $('textarea').ckeditor();
            var mainImgWrap = "";
            var mainImgArray = [];
            var footerImgWrap = "";
            var footerImgArray = [];

            @if ($general->logo != "")
                $('.upload__btn-img').addClass('d-none');
            @endif
            @if($general->footer_logo != "")
                $('.footer_upload__btn-img').addClass('d-none');
            @endif

            $('#image').on('change', function(e) {
                mainImgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {
                    if (!f.type.match('image.*')) {
                        return;
                    }

                    $('.upload__btn-img').addClass('d-none');

                    if (mainImgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < mainImgArray.length; i++) {
                            if (mainImgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            mainImgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html =
                                    "<div class='upload__img-box'><div style='background-image: url(" +
                                    e.target.result + ")' data-number='" + $(
                                        ".upload__img-close").length + "' data-file='" + f
                                    .name +
                                    "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                mainImgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });

            $('#footer_image').on('change', function(e) {
                footerImgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {
                    if (!f.type.match('image.*')) {
                        return;
                    }

                    $('.footer_upload__btn-img').addClass('d-none');

                    if (footerImgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < footerImgArray.length; i++) {
                            if (footerImgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            footerImgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html =
                                    "<div class='upload__img-box'><div style='background-image: url(" +
                                    e.target.result + ")' data-number='" + $(
                                        ".upload__img-close").length + "' data-file='" + f
                                    .name +
                                    "' class='img-bg'><div class='footer_upload__img-close'></div></div></div>";
                                footerImgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });

            const ImagesToRemove = [];
            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                const id = $(this).attr('data-id')
                if (id != "" || id !== undefined) {
                    ImagesToRemove.push(id);
                }
                for (var i = 0; i < mainImgArray.length; i++) {
                    if (mainImgArray[i].name === file) {
                        mainImgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                $('#image').val(null);
                if (mainImgArray.length <= 0) {
                    $('.upload__btn-img').removeClass('d-none');
                }
            });

            const footerImagesToRemove = [];
            $('body').on('click', ".footer_upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                const id = $(this).attr('data-id')
                if (id != "" || id !== undefined) {
                    footerImagesToRemove.push(id);
                }
                for (var i = 0; i < footerImgArray.length; i++) {
                    if (footerImgArray[i].name === file) {
                        footerImgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                $('#footer_image').val(null);
                if (footerImgArray.length <= 0) {
                    $('.footer_upload__btn-img').removeClass('d-none');
                }
            });

            /*File Uplaoders*/
            $("#main_image").uploader({
                autoUpload: false,
            });




            $('#submit').click(function() {
                saveProduct('.btn-primary', 'Submit');
            });

            /*Saving Product Function*/
            function saveProduct(btnClass, text) {
                let image = $('input[name="image"]').val();
                let footer_image = $('input[name="footer_image"]').val();
                const name = $('input[name="name"]').val();
                const email = $('input[name="email"]').val();
                const address = $('input[name="address"]').val();
                const phone = $('input[name="phone"]').val();
                const office_timing = $('input[name="office_timing"]').val();
                const warehouse_address = $('input[name="warehouse_address"]').val();
                const map = $('input[name="map"]').val();
                const facebook = $('input[name="facebook"]').val();
                const instagram = $('input[name="instagram"]').val();
                const twitter = $('input[name="twitter"]').val();

                let error_1 = true, error_2, error_3, error_4, error_5, error_6 = true, error_7, error_9 = true,error_8 = true;
                /*Applying Validation Before Save*/

                @if ($general->logo == "")
                    if (!image) {
                        $('.main_image-error').html(`Please select image`);
                        error_1 = false;
                    }else{
                        $('.main_image-error').html(``);
                        error_1 = true;
                    }
                @endif

                @if ($general->footer_logo == "")
                    if (!footer_image) {
                        $('.footer_image-error').html(`Please select image`);
                        error_6 = false;
                    }else{
                        $('.footer_image-error').html(``);
                        error_6 = true;
                    }
                @endif


                if (!$.trim(name)) {
                    $('.name-error').html(`The name field is required.`);
                    error_2 = false;
                }else{
                    $('.name-error').html(``);
                    error_2 = true;
                }

                if (!$.trim(email)) {
                    $('.email-error').html(`The email field is required.`);
                    error_5 = false;
                }else{
                    $('.email-error').html(``);
                    error_5 = true;
                }

                if (!$.trim(address)) {
                    $('.address-error').html(`The address field is required.`);
                    error_3 = false;
                }else{
                    $('.address-error').html(``);
                    error_3 = true;
                }

                if (!$.trim(office_timing)) {
                    $('.office_timing-error').html(`The Office Timing field is required.`);
                    error_7 = false;
                }else{
                    $('.office_timing-error').html(``);
                    error_7 = true;
                }

                if (!$.trim(warehouse_address)) {
                    $('.warehouse_address-error').html(`The Warehouse Address field is required.`);
                    error_8 = false;
                }else{
                    $('.warehouse_address-error').html(``);
                    error_8 = true;
                }

                if (!$.trim(map)) {
                    $('.map-error').html(`The shipping label Address field is required.`);
                    error_9 = false;
                }else{
                    $('.map-error').html(``);
                    error_9 = true;
                }

                if (!$.trim(phone)) {
                    $('.phone-error').html(`The phone field is required.`);
                    error_4 = false;
                }else{
                    $('.phone-error').html(``);
                    error_4 = true;
                }
                console.log({error_1 , error_2 , error_3 , error_4 , error_5 , error_6 , error_7 , error_8})
                if(error_1 && error_2 && error_3 && error_4 && error_5 && error_6 && error_7 && error_8 && error_9) {

                    console.log('working')
                    image = document.getElementById('image').files[0];
                    footer_image = document.getElementById('footer_image').files[0];
                    const formData = new FormData();
                    formData.append('image', image);
                    formData.append('footer_image', footer_image);
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('address', address);
                    formData.append('office_timing', office_timing);
                    formData.append('warehouse_address', warehouse_address);
                    formData.append('phone', phone);
                    formData.append('map', map);
                    formData.append('facebook', facebook);
                    formData.append('instagram', instagram);
                    formData.append('twitter', twitter);
                    formData.append('_token', _token);
                    formData.append('_method', 'PUT');
                    formData.append('id', "{{ $general->id }}");
                    /*Sending Store Book Ajax Request*/
                    const route = "{{ route('admin.general.update', ':id') }}";
                    const url = route.replace(':id', "{{ $general->id }}");
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            btnDisableHandler(btnClass, true, 'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler(btnClass, false, text);
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            } else if (res.success == false) {
                                if (res.response.name) {
                                    sweetAlertMessage('error', res.response.name[0]);
                                    $('input[name="name"]').focus();
                                }
                                if (res.response.phone_number) {
                                    sweetAlertMessage('error', res.response.phone_number[0]);
                                    $('input[name="slug"]').focus();
                                }
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    })



                }


            }


        });
    </script>
@endpush
