<!-- .reviews -->
<div class="reviews">
    <h3>Reviews</h3>



    @forelse ($dataCount as $index => $value)
    <div class="progress-parent">
        <span class="star">
            {{ $index }} <i class="fas fa-star"></i>
        </span>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $dataPercent[$index] }}%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <span class="count">{{ $value }}</span>
    </div>
    @empty
    @for ($i = 5; $i >= 1; $i--)
    <!-- .progress-parent -->
    <div class="progress-parent">
        <span class="star">
            {{ $i }} <i class="fas fa-star"></i>
        </span>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <span class="count">0</span>
    </div>
    <!-- ./progress-parent -->
    @endfor
    @endforelse



    <div class="avg-rate">
        <h3 class="mb-0">
            Average Rating
        </h3>
        <div class="avg-rate-stars d-flex align-items-center justify-content-between flex-wrap">
            <span>
                @for ($i = 1; $i <= (int) $averageRating; $i++)
                <i class="fas fa-star"></i>
                @endfor
                @for ($i = 1; $i <= 5 - (int) $averageRating; $i++)
                <i class="far fa-star"></i>
                @endfor
            </span>
            <span class="total-rate">
                {{ $averageRating }}
            </span>
        </div>
    </div>
</div>
<!-- ./reviews -->
