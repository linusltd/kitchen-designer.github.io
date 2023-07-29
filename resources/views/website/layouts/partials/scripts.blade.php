
<script src="https://example.com/fontawesome/v6.4.0/js/all.js" data-auto-replace-svg="nest"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- jQuery validation library -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
@stack('scripts')
<script>
    $(document).ready(function(){

        //Pagination Working For Comments
        // $('body').delegate('.pagination-links .page-link', 'click', function(e){
        //         e.preventDefault();
        //         if($(this).attr('href')){
        //             var page = $(this).attr('href').split('page=')[1];
        //             // const url = `${$('input[name="url"]').val()}?page=${page}`;
        //             fetchComments(page);
        //         }
        //     });


        //     //Fetch Comments
        //     function fetchComments(url){
        //         $.ajax({
        //                 url:url,
        //                 method:'GET',
        //                 success:function(res){
        //                     $('#reviews-compoent').html(res);
        //                 },error:function(xhr){
        //                     console.log(xhr.responseText);
        //                 }
        //             })
        //     }

        /*Showing Sidebar Menu*/
        $('.hamburger__ico').click(function(){
            $('.mb__sidebar-wrapper').removeClass('d-none')
            $('.mb__sidebar').removeClass('sidebar-close')
            $('.mb__sidebar').addClass('sidebar-open')
        })

        $('.sidebar__close').click(function(){
            $('.mb__sidebar').removeClass('sidebar-open')
            $('.mb__sidebar').addClass('sidebar-close')
            setTimeout(() => {
                $('.mb__sidebar-wrapper').addClass('d-none')
            }, 300)
        })

        /*Hiding Showing Sidebar tabs*/
        $('body').delegate('.mb__tabs-link', 'click', function(){
            const id = $(this).attr('id')
            const dataId = $(this).attr('data-id')

            $('.mb_active').removeClass('mb_active')
            $(this).addClass('mb_active')
            $(id).removeClass('mb_menu_active')
            $(dataId).addClass('mb_menu_active')

        });

        /*On Scroll Fix the Navbar*/
        window.addEventListener("scroll", function() {
            var navbar = document.getElementById("navbar");
            var messageComponent = document.querySelector('.message')
            var navbarHeight = navbar.offsetHeight; // Get the height of the navbar

            if (window.pageYOffset > navbarHeight) {
                navbar.classList.add("navbar-fixed");
                messageComponent.classList.add('d-none')
            } else {
                navbar.classList.remove("navbar-fixed");
                messageComponent.classList.remove('d-none')
            }
        });

        /*Scroll To Up Button*/
        window.addEventListener("scroll", function() {
            var navbar = document.getElementById("navbar");
            var navbarHeight = navbar.offsetHeight;
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");

            if (window.pageYOffset > navbarHeight) {
                navbar.classList.add("navbar-fixed");
                scrollToTopBtn.classList.add("show");
            } else {
                navbar.classList.remove("navbar-fixed");
                scrollToTopBtn.classList.remove("show");
            }
            });

            var scrollToTopBtn = document.getElementById("scrollToTopBtn");
            scrollToTopBtn.addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });

        /*Showing Login Popup*/
        $('.desktop__user').click(function(){
            let id = $(this).attr('data-id')
            if(id == 0){
                $('.login__popup').attr('class','login__popup')
                $(this).attr('data-id', 1)
            }else{
                $('.login__popup').attr('class','login__popup d-none')
                $(this).attr('data-id', 0)
            }

        })

        @include('website.common.jsHelper')

        /*Add Item To Cart*/
        $('body').delegate('#addToCartBtn', 'click', function(){
            const book_id = $(this).attr('data-id')
            $('#myModal').css({display:'none'})
            $.ajax({
                url:"{{ route('website.cart.add.to.cart') }}",
                method:"POST",
                data:{book_id, _token:"{{ csrf_token() }}"},
                success:function(response){
                    $('#cartModalHtml').html(response)
                    $('#addToCartModal').css({display:'block'})
                    getCartCount();
                    getCartTotal();
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        });

        /*Add Item Quick View*/
        $('body').delegate('#addToCartBtnQuickView', 'click', function(){
            const book_id = $(this).attr('data-id')
            const quantity = $(this).parent().find('input[name="quantity"]').val()
            const obj = $(this).get(0)
            $('#myModal').css({display:'none'})
            $.ajax({
                url:"{{ route('website.cart.add.to.cart-quick-view') }}",
                method:"POST",
                data:{book_id, quantity, _token:"{{ csrf_token() }}"},
                success:function(response){
                    if(obj.classList.contains('buy_now-btn')){
                        window.location = "{{ route('website.cart.index') }}";
                    }else{
                        $('#cartModalHtml').html(response)
                        $('#addToCartModal').css({display:'block'})
                        getCartCount();
                        getCartTotal();
                    }

                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        });

        /*Quick View Loader*/
        $('body').delegate('#quickView', 'click', function(){
            const id = $(this).attr('data-id')

            $.ajax({
                url:"{{ route('website.home.quick-view') }}",
                method:"GET",
                data:{id, _token:"{{ csrf_token() }}"},
                success:function(response){
                    $('#quickViewBookContent').html(response)
                    $('#myModal').css({display:'block'})
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        })

        /*Closing Modals*/
        $('body').delegate('.close', 'click', function(){
            $('#myModal').css({display:'none'})
            $('#addToCartModal').css({display:'none'})
            $('#cartModal').css({display:'none'})
        })

        /*Closing Modals*/
        $('body').delegate('.modal__close-icon', 'click', function(){
            $('#myModal').css({display:'none'})
            $('#addToCartModal').css({display:'none'})
            $('#cartModal').css({display:'none'})
        })

        /*Opening Cart Modal*/
        $('#openCartModal').click(function(){
            $.ajax({
                url:"{{ route('website.cart.cart-content') }}",
                method:"GET",
                data:{_token:"{{ csrf_token() }}"},
                success:function(response){
                    $('#cartContent').html(response)
                    $('#cartModal').css({display:'block'})
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })
        })

        /*Increase Quanatity*/
        $('body').delegate('#increaseQuantity', 'click', function(){
            const currentQuantityInput = $(this).parent().find('input[name="quantity"]')
            const currentQuantityValue = $(this).parent().find('input[name="quantity"]').val()
            $(this).parent().find('input[name="quantity"]').val(parseInt(currentQuantityValue) + 1)
        })

        /*Decrease Quanatity*/
        $('body').delegate('#deacreaseQuanatity', 'click', function(){
            const currentQuantityInput = $(this).parent().find('input[name="quantity"]')
            const currentQuantityValue = $(this).parent().find('input[name="quantity"]').val()
            if(currentQuantityValue > 1){
                $(this).parent().find('input[name="quantity"]').val(parseInt(currentQuantityValue) - 1)
            }
        })

        /*Add To Wish List*/
        $('body').delegate('#addToWishList', 'click', function(){
            const book_id = $(this).attr('data-id')

            $.ajax({
                url:"{{ route('website.wishlist.add-to-wishlist') }}",
                method:"POST",
                data:{book_id, _token:"{{ csrf_token() }}"},
                success:function(response){
                    if(response.success == true){
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        x.innerHTML = response.html
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 7000);
                    }else{
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        x.innerHTML = response.html
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 7000);
                    }
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        })

        /*Closing WishList Modal*/
        $('body').delegate('.wishlist__cross', 'click', function(){
            var x = document.getElementById("snackbar");
            x.className = "close";
        })

        /*Get Wishlist Item*/
        function getWishList(){
            $.ajax({
                url:"{{ route('website.wishlist.get') }}",
                method:"GET",
                success:function(response){
                    $('#wishListBody').html(response)
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })
        }

        /*Removing WishListt Item*/
        $('body').delegate('#removeItemFromWishList', 'click', function(){
            const id = $(this).attr('data-id')

            $.ajax({
                url:"{{ route('website.wishlist.remove-item') }}",
                method:"POST",
                data:{id, _token:"{{ csrf_token() }}"},
                success:function(response){
                    if(response.count > 0){
                        getWishList()
                    }else{
                        window.location.reload();
                    }
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        })

        /*Clearing WishList*/
        $('#clearWishList').click(function(){
            $.ajax({
                url:"{{ route('website.wishlist.clear-all') }}",
                method:"GET",
                data:{_token:"{{ csrf_token() }}"},
                success:function(response){
                    window.location.reload();
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })
        });

        /*Add To Cart Wish List*/
        $('body').delegate('#addToCartWishList', 'click', function(){
            const id = $(this).parent().find('input[name="id"]').val()
            const book_id = $(this).parent().find('input[name="book_id"]').val()
            $.ajax({
                url:"{{ route('website.cart.add.to.cart-wishlist') }}",
                method:"POST",
                data:{id, book_id, _token:"{{ csrf_token() }}"},
                success:function(response){
                    getCartCount()
                    getWishList()
                    if(response.wishlilsts.length <= 1){
                        window.location.reload()
                    }
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })
        })

        // /*Add To Cart Wish List*/
        $('#addAllToCart').click(function(){
            $.ajax({
                url:"{{ route('website.cart.add.to.cart-all-wishlist') }}",
                method:"POST",
                data:{ _token:"{{ csrf_token() }}"},
                success:function(response){
                    getCartCount()
                    window.location.reload()
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })
        })


        /*Implementing Search Functionality*/
        $('#navbar__search-input').keyup(function(){
            const search = $(this).val()

            if(search == ""){
                $('.search__books').css({display:'none'})
                        $('#bookSearchWrapper').html('')
                return
            }

            $.ajax({
                url:"{{ route('website.home.search-book') }}",
                method:"GET",
                data:{search},
                success:function(response){
                    if(response !== ''){
                        $('.search__books').css({display:'block'})
                        $('#bookSearchWrapper').html(response)
                    }else{
                        $('.search__books').css({display:'none'})
                        $('#bookSearchWrapper').html('')
                    }
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        });

        /*Implementing Search Functionality*/
        $('#mobilenavbar__search-input').keyup(function(){
            const search = $(this).val()

            if(search == ""){
                $('#mobilebookSearchWrapper').html('')
                return
            }

            $.ajax({
                url:"{{ route('website.home.search-book') }}",
                method:"GET",
                data:{search},
                success:function(response){
                    if(response !== ''){
                        $('#mobilebookSearchWrapper').html(response)
                    }else{
                        $('#mobilebookSearchWrapper').html('')
                    }
                },
                error:function(xhr){
                    console.log(xhr.responseText)
                }
            })

        });


        /*Auto Load Pagination Code*/
        // const paginationURL = $('input[name="url"]').val();
        // let page = 1;

        // $(window).scroll(function(){
        //     if($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)){
        //         page++;
        //     }
        // })

    })
</script>


