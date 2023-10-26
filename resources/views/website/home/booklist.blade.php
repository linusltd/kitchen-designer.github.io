<div class="books__wrapper">
    @foreach ($books as $book)
        <article class="book__card">
            <div class="book__img-wrapper">
                <a href="{{ route('website.home.book-detail-view', $book->slug) }}">
                    <img src="{{ asset('storage/' . $book->images[0]->filename) }}" alt="{{ $book->title }}"
                        class="book__img">

                </a>
            </div>
            <div class="book__info-wrapper">
                <div class="quick__view-wrapper">
                    <div class="tooltip"><i class="fa-regular fa-eye" id="quickView" data-id="{{ $book->id }}"></i>
                        <div class="top">
                            <p>Quick View</p>
                            <i></i>
                        </div>
                    </div>
                    @if ($book->reviews->count())
                        @php
                            $averageRating = $book->reviews->avg('ratings');
                            $fullStars = floor($averageRating);
                            $halfStar = $averageRating - $fullStars;
                            $emptyStars = 5 - $fullStars - ceil($halfStar);
                        @endphp
                        <div class="ratings-wrapper">
                            @for ($i = 1; $i <= $fullStars; $i++)
                                <img src="{{ asset('assets/website') }}/images/star.svg" class="" />
                            @endfor

                            @if ($halfStar > 0)
                                {{-- Half Star --}}
                                <img src="{{ asset('assets/website') }}/images/star.svg" class="" />
                            @endif
                            {{-- Full Star --}}
                            @for ($i = 1; $i <= $emptyStars; $i++)
                                <img src="{{ asset('assets/website') }}/images/star.svg" class="" />
                            @endfor
                        </div>
                    @else
                        <div class="ratings-wrapper">
                            <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="" />
                            <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="" />
                            <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="" />
                            <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="" />
                            <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="" />
                        </div>
                    @endif
                    <div class="tooltip"><i class="fa-regular fa-heart" id="addToWishList"
                            data-id="{{ $book->id }}"></i>
                        <div class="top">
                            <p>Add To Wishlist</p>
                            <i></i>
                        </div>
                    </div>
                </div>

                <a class="book__name" href="{{ route('website.home.book-detail-view', $book->slug) }}">
                    {{ $book->name }}
                </a>

                <div class="book__price">
                    @if ($book->price !== $book->special_price)
                        <span class="book__real__price">
                            Rs.{{ $book->price }}
                        </span>
                    @endif
                    <span class="book__special__price">Rs.{{ $book->special_price }}</span>
                </div>
                <button class="btn book__addtocart-btn" id="addToCartBtn" data-id="{{ $book->id }}">Add To
                    Cart</button>
            </div>
        </article>
    @endforeach
</div>

<div class="pagination pagination-links">
    {{ $books->links() }}
</div>
