@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper')
            let editorInstance;
            let editorHighlightsInstance;
            /*Loading CkEditor*/
            CKEDITOR.ClassicEditor
            .create( document.querySelector( '#highlights' ), {
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo', '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                placeholder: 'Write Product Description here!',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                lineHeight: {
                    options: [ 1, 1.15, 1.5, 2 ]
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                htmlEmbed: {
                    showPreviews: true
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                removePlugins: [
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents'
                ]
            } )
            .then( editor => {
                editorHighlightsInstance = editor;
                // console.log( 'Editor initialized successfully:', editor );

                $('#getValueButton').click(function() {
                    var editorData = editor.getData();
                    // console.log('Editor Value:', editorData);
                });
            } )
            .catch( error => {
                console.error( 'Error initializing editor:', error );
            } );
            /*Loading CkEditor*/
            CKEDITOR.ClassicEditor
            .create( document.querySelector( '#description' ), {
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo', '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                placeholder: 'Write Product Description here!',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                lineHeight: {
                    options: [ 1, 1.15, 1.5, 2 ]
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                htmlEmbed: {
                    showPreviews: true
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                removePlugins: [
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents'
                ]
            } )
            .then( editor => {
                editorInstance = editor;
                // console.log( 'Editor initialized successfully:', editor );

                $('#getValueButton').click(function() {
                    var editorData = editor.getData();
                    // console.log('Editor Value:', editorData);
                });
            } )
            .catch( error => {
                console.error( 'Error initializing editor:', error );
            } );

            var mainImgWrap = "";
            var mainImgArray = [];
            var sideImgWrap = "";
            var sideImgArray = [];

            $('.upload__btn-img').addClass('d-none');

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

            /*File Uplaoders*/
            $("#main_image").uploader({
                autoUpload: false,
            });

            $("#multi_image").uploader({
                multiple: true,
            });

            /*Multiselect*/
            $('#category_id').select2({
                placeholder: '--select categories--'
            });
;

            $('#submitProductBtn').click(function() {
                saveProduct("{{ $book->status }}", '.btn-primary', 'Submit');
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
                const description = editorInstance.getData();
                const highlights = editorHighlightsInstance.getData();
                let images = $('input[name="images[]"]').val();
                const price = $('input[name="price"]').val();
                const weight = $('input[name="weight"]').val();
                const special_price = $('input[name="special_price"]').val();
                const low_stock_min = $('input[name="low_stock_min"]').val();
                const meta_keywords = $('input[name="meta_keywords"]').val();
                const meta_description = $('textarea[name="meta_description"]').val();
                const in_stock = $('select[name="in_stock"]').val();

                /*Applying Validation Before Save*/
                if (!$.trim(name)) {
                    $('.main_image-error').html(``);
                    $('.name-error').html(`enter book name.`);
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
                }else if (!$.trim(highlights).length) {
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
                    $('.highlights-error').html(`please enter book description`);
                }  else if (!$.trim(description).length) {
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
                    $('.highlights-error').html(``);
                    $('.description-error').html(`please enter book description`);
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
                    $('.highlights-error').html(``);
                    $('.price-error').html(`book price should be less than 0`);
                    $('input[name="price"]').focus();
                } else if (!$.trim(weight).length || weight <= 0) {
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
                    $('.highlights-error').html(``);
                    $('.price-error').html(``);
                    $('.weight-error').html(`book weight should be less than 0`);
                    $('input[name="price"]').focus();
                } else {
                    $('.weight-error').html(``);
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
                    $('.highlights-error').html(``);
                    image = document.getElementById('image').files[0];
                    const formData = new FormData();
                    formData.append('name', name);
                    formData.append('slug', slug);
                    formData.append('category_id', category_id);
                    formData.append('description', description);
                    formData.append('highlights', highlights);
                    formData.append('price', price);
                    formData.append('weight', weight);
                    formData.append('special_price', special_price);
                    formData.append('low_stock_min', low_stock_min);
                    formData.append('meta_keywords', meta_keywords);
                    formData.append('meta_description', meta_description);
                    formData.append('in_stock', in_stock);
                    formData.append('status', status);
                    formData.append('image', image);
                    formData.append('_token', _token);
                    formData.append('id', "{{ $book->id }}");
                    formData.append('_method', 'PUT');
                    if (sideImgArray.length > 0) {
                        for (let index = 0; index < sideImgArray.length; index++) {
                            formData.append("images[]", sideImgArray[index]);
                        }
                    }
                    if (ImagesToRemove.length > 0) {
                        for (let index = 0; index < ImagesToRemove.length; index++) {
                            formData.append("ImagesToRemove[]", ImagesToRemove[index]);
                        }
                    }
                    /*Sending Store Product Ajax Request*/
                    const route = "{{ route('admin.books.update', ':id') }}";
                    const url = route.replace(':id', "{{ $book->id }}");
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
                                    window.location = "{{ route('admin.books.index') }}";
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
