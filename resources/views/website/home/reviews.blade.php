<div class="product__reviews-list">
@foreach ($reviews as $item)
        <article class="product__review-item">
            <div class="user__avatar">
                <img src="{{ asset('assets/website/images/reviewer.jpeg') }}" alt="">
            </div>
            <div class="review__info">
                <div class="ratings-wrapper">
                    @php
                    $averageRating = $item->ratings;
                    $fullStars = floor($averageRating);
                    $halfStar = $averageRating - $fullStars;
                    $emptyStars = 5 - $fullStars - ceil($halfStar);
                    @endphp
                    @for ($i = 1; $i <= $fullStars; $i++)
                    <img src="{{ asset('assets/website') }}/images/star.svg" class="ratin__star"/>
                    @endfor

                    @if ($halfStar > 0)
                    {{-- Half Start --}}
                        <img src="{{ asset('assets/website') }}/images/hald_star.svg" class="ratin__star"/>
                    @endif

                    @for ($i = 1; $i <= $emptyStars; $i++)
                        {{-- Full Start --}}
                        <img src="{{ asset('assets/website') }}/images/bland_star.svg" class="ratin__star"/>
                    @endfor
                </div>
                <p class="reviewer">
                    <span class="reviewer__name">
                        {{ $item->name }} -
                    </span>
                    <span class="reviewe__date">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}
                    </span>
                </p>
                <p class="review__comment">{{ $item->review }}</p>
            </div>
        </article>

@endforeach
{{-- <div class="pagination pagination-links">
    {{ $reviews->links() }}
</div> --}}
</div>
