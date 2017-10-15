<div class="panel-body">
    <b>Note : </b>
    @for ($i = 1; $i < 6; $i++)
        <i class="fa fa-star" style="{{ $review->rating >= $i ? 'color:#ec6f75;' : ''}}" aria-hidden="true"></i>
    @endfor
    -
    <b>Prix : </b>
    @for ($i = 1; $i < 6; $i++)
        <i class="fa fa-eur" style="{{ $review->price >= $i ? 'color:#ec6f75;' : ''}}" aria-hidden="true"></i>
    @endfor
    <br>
    {{ $review->comment }}
</div>