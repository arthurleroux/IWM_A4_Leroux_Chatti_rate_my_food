<div class="panel-body">
    Note : {{ $review->rating }}/5
    <br>
    Prix : {{ $review->price }}/5
    <br>
    <br>
    {{ $review->comment }}
    <br>
    <br>
    @if(Auth::check() && (Auth::user()->is_admin === 1) || (Auth::user()->id === $review->user_id))

        <div class="col-md-1">
            <a href="{{ route('reviews.edit', $review->id) }}">
                <button class="btn btn-default">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
            </a>
        </div>

        <div class="col-md-1">
            {!! Form::model($review,
                    array(
                        'route' => array('reviews.destroy', $review->id),
                        'method' => 'DELETE'))
                !!}
            <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
            {!! Form::close() !!}
        </div>
    @endif
</div>