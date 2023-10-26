@push('scripts')
    <script>
        $(document).ready(function() {
            @include('admin.common.jshelper')
            $('#submitReview').click(function() {
                const name = $('#add__review-form input[name="name"]').val();
                const email = $('#add__review-form input[name="email"]').val();
                const ratings = $('input[name="rating"]:checked').val();
                const review = $('#add__review-form textarea').val();
                const book_id = "{{ $book->id }}";
                const user_id = "{{ Auth::user() ? Auth::user()->id : 0 }}";
                if (!$.trim(name) || !$.trim(name) || !$.trim(ratings) || !$.trim(review)) {
                    $('.reviewmessage').html(
                        `<span style="color:red">Not all the fields have been filled out correctly!</span>`
                        )
                } else {
                    $('.reviewmessage').html('');

                    $.ajax({
                        url: "{{ route('website.home.add-review') }}",
                        method: "POST",
                        data: {
                            name,
                            email,
                            ratings,
                            review,
                            book_id,
                            user_id,
                            _token
                        },
                        success: function(response) {
                            $('.reviewmessage').html(
                                `<span style="color:green">Your Review has been submited successfully!. it will list once verified!</span>`
                                )
                            $('#add__review-form input[name="name"]').val('');
                            $('#add__review-form input[name="email"]').val('');
                            $('input[name="rating"]:checked').val('');
                            $('#add__review-form textarea').val('');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText)
                        }
                    });

                }

            })

        })
    </script>
@endpush
