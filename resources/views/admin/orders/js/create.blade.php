@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper')

            const SEO_EXAMPLE = `<meta name="keywords" content="Tib e Nabvi, Medicine of Prophet, Prophetic Cure, Islamic Medicine, Darussalam, Online Islamic Products, Best Islamic Products"> <br/>
            <meta name="description" content="Tib-e-Nabvi, written by Ibn al-Qayyim is a collection of spiritual and medical healing manuscripts as reported by the Prophet ﷺ. Order online at Darussalam e-Store.">
            <meta property="og:title" content="Tib-e-Nabvi - Best Book to Learn the Prophetic Medicine | Darussalam">
            <meta property="og:url" content="https://darussalam.pk/books/family/tib-e-nabvi/">
            <meta property="og:image" content="https://darussalam.pk/images/detailed/25/darussalam-2017-06-14-15-15-32tib-e-nabvi-_1_.png">
            <meta property="og:image:width" content="1000">
            <meta property="og:image:height" content="1360">
            <meta property="og:site_name" content="Darussalam Pakistan">
            <meta property="og:type" content="activity">`;
            $('#showSEOExample').html(SEO_EXAMPLE);
            console.log(JSON.stringify(SEO_EXAMPLE))

            /*Loading CkEditor*/
            $('#description').ckeditor();
            var mainImgWrap = "";
            var mainImgArray = [];
            var sideImgWrap = "";
            var sideImgArray = [];

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

            $('#images').on('change', function(e) {
                sideImgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {
                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (sideImgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < sideImgArray.length; i++) {
                            if (sideImgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            sideImgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html =
                                    "<div class='upload__img-box'><div style='background-image: url(" +
                                    e.target.result + ")' data-number='" + $(
                                        ".upload__img-close").length + "' data-file='" + f
                                    .name +
                                    "' class='img-bg'><div class='upload__imges-close'></div></div></div>";
                                sideImgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });

            $('body').on('click', ".upload__imges-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < sideImgArray.length; i++) {
                    if (sideImgArray[i].name === file) {
                        sideImgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();

            });


            /*Multiselect*/
            $('#category_id').select2({
                placeholder: '--select categories--'
            });

            /*Multiselect*/
            $('#author_id').select2({
                placeholder: '--select authors--'
            });

            /*Multiselect*/
            $('#language_id').select2({
                placeholder: '--select languages--'
            });

            $('#saveDraftBtn').click(function() {
                saveProduct(2, '.btn-secondary', 'Save Draft');
            });

            $('#submitBookBtn').click(function() {
                saveProduct(1, '.btn-primary', 'Submit');
            });


            /*Creating Slug*/
            $('input[name="name"]').keyup(function() {
                const val = $(this).val().toLowerCase();
                const slug = $('input[name="slug"]').val(
                    `${val.replace(/[ ]/g,(m => m === ' ' ? '-' : ' '))}`);
            });

            /*Saving Product Function*/
            function saveProduct(status, btnClass, text) {
                let image = $('input[name="image"]').val();
                const name = $('input[name="name"]').val();
                const slug = $('input[name="slug"]').val();
                const category_id = $('select[name="category_id[]"]').val();
                const pages = $('input[name="pages"]').val();
                const binding = $('input[name="binding"]').val();
                const volume = $('input[name="volume"]').val();
                const size = $('input[name="size"]').val();
                const author_id = $('select[name="author_id[]"]').val();
                const language_id = $('select[name="language_id[]"]').val();
                const description = CKEDITOR.instances["description"].getData();
                let images = $('input[name="images[]"]').val();
                const price = $('input[name="price"]').val();
                const special_price = $('input[name="special_price"]').val();
                const low_stock_min = $('input[name="low_stock_min"]').val();
                const meta_keywords = $('input[name="meta_keywords"]').val();
                const meta_description = $('textarea[name="meta_description"]').val();
                const in_stock = $('select[name="in_stock"]').val();

                /*Applying Validation Before Save*/
                if (image == "") {
                    $('.main_image-error').html(`please selelect image.`);
                    $('input[name="name"]').focus();
                } else if (!$.trim(name)) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(`enter book name.`);
                    $('input[name="name"]').focus();
                } else if (!$.trim(slug)) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(`enter book slug.`);
                    $('input[name="slug"]').focus();
                } else if (category_id.length <= 0) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(`select book categories.`);
                } else if (!$.trim(pages)) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(`enter book pages`);
                    $('input[name="pages"]').focus();
                } else if (author_id.length <= 0) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(``);
                    $('.binding-error').html(``);
                    $('.volume-error').html(``);
                    $('.size-error').html(``);
                    $('.author_id-error').html(`select author.`);
                } else if (language_id.length <= 0) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(``);
                    $('.binding-error').html(``);
                    $('.volume-error').html(``);
                    $('.size-error').html(``);
                    $('.author_id-error').html(``);
                    $('.language_id-error').html(`select language.`);
                } else if (!$.trim(description).length) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(``);
                    $('.binding-error').html(``);
                    $('.volume-error').html(``);
                    $('.size-error').html(``);
                    $('.author_id-error').html(``);
                    $('.language_id-error').html(``);
                    $('.description-error').html(`please enter book description`);
                } else if (sideImgArray.length <= 0) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(``);
                    $('.binding-error').html(``);
                    $('.volume-error').html(``);
                    $('.size-error').html(``);
                    $('.author_id-error').html(``);
                    $('.language_id-error').html(``);
                    $('.description-error').html(``);
                    $('.images-error').html(`please select different angle images of book.`);
                    $('input[name="price"]').focus();
                } else if (!$.trim(price).length || price <= 0) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(``);
                    $('.binding-error').html(``);
                    $('.volume-error').html(``);
                    $('.size-error').html(``);
                    $('.author_id-error').html(``);
                    $('.language_id-error').html(``);
                    $('.description-error').html(``);
                    $('.images-error').html(``);
                    $('.price-error').html(`book price should be less than 0`);
                    $('input[name="price"]').focus();
                } else {
                    $('.main_image-error').html(``);
                    $('.name-error').html(``);
                    $('.slug-error').html(``);
                    $('.category_id-error').html(``);
                    $('.pages-error').html(``);
                    $('.binding-error').html(``);
                    $('.volume-error').html(``);
                    $('.size-error').html(``);
                    $('.author_id-error').html(``);
                    $('.language_id-error').html(``);
                    $('.description-error').html(``);
                    $('.images-error').html(``);
                    $('.price-error').html(``);

                    image = document.getElementById('image').files[0];
                    images = document.getElementById('images').files.length;
                    const formData = new FormData();
                    formData.append('name', name);
                    formData.append('slug', slug);
                    formData.append('category_id', category_id);
                    formData.append('pages', pages);
                    formData.append('binding', binding);
                    formData.append('volume', volume);
                    formData.append('in_stock', in_stock);
                    formData.append('size', size);
                    formData.append('author_id', author_id);
                    formData.append('language_id', language_id);
                    formData.append('description', description);
                    formData.append('price', price);
                    formData.append('special_price', special_price);
                    formData.append('low_stock_min', low_stock_min);
                    formData.append('meta_keywords', meta_keywords);
                    formData.append('meta_description', meta_description);
                    formData.append('status', status);
                    formData.append('image', image);
                    formData.append('_token', _token);
                    if (sideImgArray.length > 0) {
                        for (let index = 0; index < sideImgArray.length; index++) {
                            formData.append("images[]", sideImgArray[index]);
                        }
                    }
                    /*Sending Store Book Ajax Request*/
                    $.ajax({
                        url: "{{ route('admin.books.store') }}",
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
                            // console.log(res);
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
