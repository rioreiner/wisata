@props(['rating' => 0, 'maxStars' => 5])

<div class="rating-stars">
    @for($i = 1; $i <= $maxStars; $i++)
        <i class="fas fa-star{{ $i <= $rating ? '' : '-o' }}"></i>
    @endfor
    @if($rating > 0)
        <span class="ms-1 text-muted">({{ number_format($rating, 1) }})</span>
    @endif
</div>