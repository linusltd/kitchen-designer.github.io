@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper')
            /*Loading CkEditor*/
            // $('textarea').ckeditor();
            var mainImgWrap = "";
            var mainImgArray = [];

            $('.upload__btn-img').addClass('d-none');
            $('.mobile_upload__btn-img').addClass('d-none');

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

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
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

            var mobileImgWrap = "";
            var mobileImgArray = [];

            $('#mobile_image').on('change', function(e) {
                mobileImgWrap = $(this).closest('.mobile_upload__box').find('.mobile_upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {
                    if (!f.type.match('image.*')) {
                        return;
                    }

                    $('.mobile_upload__btn-img').addClass('d-none');

                    if (mobileImgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < mobileImgArray.length; i++) {
                            if (mobileImgArray[i] !== undefined) {
                                len++;
                            }
                        }

                        if (len > maxLength) {
                            return false;
                        } else {
                            mobileImgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html =
                                    "<div class='upload__img-box'><div style='background-image: url(" +
                                    e.target.result + ")' data-number='" + $(
                                        ".mobile_upload__img-close").length + "' data-file='" + f
                                    .name +
                                    "' class='img-bg'><div class='mobile_upload__img-close'></div></div></div>";
                                mobileImgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });

            $('body').on('click', ".mobile_upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < mobileImgArray.length; i++) {
                    if (mobileImgArray[i].name === file) {
                        mobileImgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                $('#image').val(null);
                if (mobileImgArray.length <= 0) {
                    $('.mobile_upload__btn-img').removeClass('d-none');
                }
            });

            /*Multiselect*/
            $('#book_id').select2({
                placeholder: '--select a book--'
            });

            /*Multiselect*/
            $('#category_id').select2({
                placeholder: '--select a category--'
            });


            const redirect = "{{ $slider->redirect }}";

            if(redirect == 0){
                    $('#bookDiv').removeClass('d-none')
                    $('#categoryDiv').addClass('d-none')
                    $('#urlDiv').addClass('d-none')
                }else if(redirect == 1){
                    $('#bookDiv').addClass('d-none')
                    $('#urlDiv').addClass('d-none')
                    $('#categoryDiv').removeClass('d-none')
                    /*Multiselect*/
                    $('#category_id').select2({
                        placeholder: '--select a category--'
                    });
                }else if(redirect == 2){
                    $('#bookDiv').addClass('d-none')
                    $('#categoryDiv').addClass('d-none')
                    $('#urlDiv').removeClass('d-none')
                }

            $('input[name="redirect"]').change(function(){
                const redirect = $(this).val()

                if(redirect == 0){
                    $('#bookDiv').removeClass('d-none')
                    $('#categoryDiv').addClass('d-none')
                    $('#urlDiv').addClass('d-none')
                }else if(redirect == 1){
                    $('#bookDiv').addClass('d-none')
                    $('#urlDiv').addClass('d-none')
                    $('#categoryDiv').removeClass('d-none')
                    /*Multiselect*/
                    $('#category_id').select2({
                        placeholder: '--select a category--'
                    });
                }else if(redirect == 2){
                    $('#bookDiv').addClass('d-none')
                    $('#categoryDiv').addClass('d-none')
                    $('#urlDiv').removeClass('d-none')
                }

            })

            /*Submitting Slider Image*/
            $('#submit').click(function() {
                const type = $('select[name="type"]').val();
                let image = $('input[name="image"]').val();
                let mobile_image = $('input[name="mobile_image"]').val();
                const redirect = $('input[name="redirect"]:checked').val();
                const color = $('input[name="color"]').val();
                const url = $('input[name="url"]').val();
                const book_id = $('select[name="book_id"]').val();
                const category_id = $('select[name="category_id"]').val();
                const status = $('input[name="status"]:checked').val();
                console.log(book_id)
                let error_1 = true;
                let error_2 = true;
                let error_3 = true;

                if(redirect == 0){
                    if(book_id == ""){
                        $('.book_id-error').html(`Please select a book.`)
                        error_2 = false;
                    }else{
                        $('.book_id-error').html(``)
                        error_2 = true;
                    }
                }else if(redirect == 1){
                    if(category_id == ""){
                        $('.category_id-error').html(`Please select a category.`)
                        error_2 = false;
                    }else{
                        $('.category_id-error').html(``)
                        error_2 = true;
                    }
                }else if(redirect == 2){
                    if(!$.trim(url)){
                        $('.url-error').html(`Please enter a url.`)
                        error_2 = false;
                    }else{
                        $('.url-error').html(``)
                        error_2 = true;
                    }
                }

                /*Applying Validation Before Save*/
                if (error_2 === true) {
                    image = document.getElementById('image').files[0];
                    mobile_image = document.getElementById('mobile_image').files[0];
                    const formData = new FormData();
                    formData.append('id', "{{ $slider->id }}");
                    formData.append('type', type);
                    if(image){
                        formData.append('image', image);
                    }
                    if(mobile_image){
                        formData.append('mobile_image', mobile_image);
                    }

                    formData.append('redirect', redirect);
                    formData.append('url', url);
                    formData.append('color', color);
                    formData.append('book_id', book_id);
                    formData.append('category_id', category_id);
                    formData.append('status', status);
                    formData.append('_method', 'PUT');
                    formData.append('_token', _token);

                    /*Sending Store Book Ajax Request*/
                    $.ajax({
                        url: "{{ route('admin.slider.update', $slider->id) }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            btnDisableHandler($('#submit'), true, 'Processing...');
                        },
                        complete: function() {
                            btnDisableHandler($('#submit'), false, 'Submit');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.success == true) {
                                sweetAlertMessage('success', res.response);
                                setTimeout(() => {
                                    window.location = "{{ route('admin.slider.index') }}";
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

            });


        });
    </script>
@endpush
