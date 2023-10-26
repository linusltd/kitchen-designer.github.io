        <!-- QUick View Modal -->
        <div id="myModal" class="modal">
            <!-- Cross Modal Button -->
            <i class="fas fa-close modal__close-icon"></i>
            <!-- Modal content -->
            <div class="modal-content" id="quickViewBookContent">

            </div>
        </div>

        <!-- Cart Modal -->
        <div id="cartModal" class="modal">
            <!-- Cross Modal Button -->
            <i class="fas fa-close modal__close-icon"></i>
            <!-- Modal content -->
            <div class="modal-content">
                <div id="cartContent"></div>
                <div class="modal-footer">
                    <a href="{{ route('website.home.shop') }}" class="btn book__addtocart-btn quick__btn">Continue
                        Shopping</a>
                    <a href="{{ route('website.cart.index') }}" class="btn buy_now-btn quick__btn">Check Out</a>
                </div>
            </div>
        </div>

        <!-- Add To Cart Modal -->
        <div id="addToCartModal" class="modal">
            <!-- Cross Modal Button -->
            <i class="fas fa-close modal__close-icon"></i>
            <!-- Modal content -->
            <div class="modal-content cart__modal">
                <div class="modal-header">
                    <i class="fas fa-close cart__modal-close"></i>
                </div>
                <div class="modal-body" id="cartModalHtml">

                </div>
            </div>

        </div>

        {{-- Whish List Popup --}}
        <div id="snackbar">

        </div>
