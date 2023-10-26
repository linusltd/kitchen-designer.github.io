@push('scripts')
    <script>
        $(document).ready(function() {
            @include('new-website.common.jsHelper')


            /*Cancel Order Request*/
            $('body').delegate('#orderCancelRequest', 'click', function() {
                const id = $(this).attr('data-id')
                const obj = $(this)
                $.ajax({
                    method: "POST",
                    url: "{{ route('website.order.create-order-request') }}",
                    data: {
                        id,
                        _token
                    },
                    beforeSend: function() {
                        obj.html(`<i class="fas fa-spinner fa-spin spinner"></i>`)
                        obj.attr('disabled', true)
                    },
                    complete: function() {
                        obj.html(`Cancel`)
                        obj.removeAttr('disabled')
                    },
                    success: function(response) {
                        obj.parent().parent().find('#orderStatus').html('Cancel Request')
                        obj.remove()
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            })
        })
    </script>
@endpush
