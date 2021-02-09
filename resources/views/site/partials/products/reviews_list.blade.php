<!-- .reviews-list -->
<div class="reviews-list">
    <ul class="list-unstyled">
        @foreach ($rates as $rate)
        <li>
            <div class="d-flex align-items-center">
                <i class="far fa-user-circle"></i>
                <span class="ml-3">
                    <span class="username ">{{ $rate->user->name }}</span>
                    <span class="rates d-flex ">
                        @for ($i = 1; $i <= $rate->value; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                        @for ($i = 1; $i <= 5 - $rate->value; $i++)
                        <i class="far fa-star"></i>
                        @endfor
                    </span>
                </span>
            </div>
            @if($review = $rate->review)
            <p class="comment">
                {{ $review }}
            </p>
            @endif
        </li>
        @endforeach
    </ul>
</div>
<!-- ./reviews-list -->
