    <!--All Vendor Js -->
    <script src="{{ asset('new-assets/website/js/vendor.js') }}"></script>
    <!-- jQuery validation library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <!-- Active Js -->
    <script src="{{ asset('new-assets/website/js/active.js') }}"></script>
    @stack('scripts')
    <script>
        $(document).ready(function() {
            @include('new-website.common.jsHelper')

            $('body').delegate('#quickView', 'click', function() {
                const id = $(this).attr('data-id')

                $.ajax({
                    url: "{{ route('website.home.quick-view') }}",
                    method: "GET",
                    data: {
                        id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#quickViewBookContent').html(response)
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })

            })

            /*Add To Wish List*/
            $('body').delegate('#addToWishList', 'click', function() {
                const book_id = $(this).attr('data-id')

                $.ajax({
                    url: "{{ route('website.wishlist.add-to-wishlist') }}",
                    method: "POST",
                    data: {
                        book_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success == true) {
                            var x = document.getElementById("snackbar");
                            x.className = "show";
                            x.innerHTML = response.html
                            setTimeout(function() {
                                x.className = x.className.replace("show", "");
                            }, 7000);
                        } else {
                            var x = document.getElementById("snackbar");
                            x.className = "show";
                            x.innerHTML = response.html
                            setTimeout(function() {
                                x.className = x.className.replace("show", "");
                            }, 7000);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })

            })

            // Delete Wishlist

            function getWishList() {
                $.ajax({
                    url: "{{ route('website.wishlist.get') }}",
                    method: "GET",
                    success: function(response) {
                        $('#wishListBody').html(response)
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })
            }

            // Delete Wishlist
            $('body').delegate('#removeItemFromWishList', 'click', function() {
                const id = $(this).attr('data-id')

                $.ajax({
                    url: "{{ route('website.wishlist.remove-item') }}",
                    method: "POST",
                    data: {
                        id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.count > 0) {
                            getWishList()
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })

            })

            // Add to Cart
            $('body').delegate('#addToCartBtn', 'click', function() {
                const book_id = $(this).attr('data-id')
                $.ajax({
                    url: "{{ route('website.cart.add.to.cart') }}",
                    method: "POST",
                    data: {
                        book_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        getCartItems();
                        getCartCount();
                        getCartTotal();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })

            });

            /*Opening Cart Modal*/
            $('#openCartModal').click(function() {
                $.ajax({
                    url: "{{ route('website.cart.cart-content') }}",
                    method: "GET",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#cartContent').html(response)
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })
            })

            // Quick View Add to Cart
            $('body').delegate('#addToCartBtnQuickView', 'click', function() {
                const book_id = $(this).attr('data-id')
                const quantity = $(this).parent().find('input[name="quantity"]').val()
                const obj = $(this).get(0)

                // $('#myModal').css({
                // display: 'none'
                // })
                $.ajax({
                    url: "{{ route('website.cart.add.to.cart-quick-view') }}",
                    method: "POST",
                    data: {
                        book_id,
                        quantity,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (obj.classList.contains('buy_now-btn')) {
                            window.location = "{{ route('website.cart.index') }}";
                        } else {
                            getCartItems();
                            getCartCount();
                            getCartTotal();
                        }

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText)
                    }
                })

            });

            // Closing Add to cart modal
            /*Closing Modals*/
            $('body').delegate('.modal__close-icon', 'click', function() {
                $('#addToCartModal').css({
                    display: 'none'
                })
            })

            // Closing Wishlist Modal
            $('body').delegate('.wishlist__cross', 'click', function() {
                var x = document.getElementById("snackbar");
                x.className = "close";
            })
        })
    </script>
