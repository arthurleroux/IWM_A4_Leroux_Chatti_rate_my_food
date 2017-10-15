<h2>Avis</h2>
@if(count($restaurant->reviews) > 0)
    @foreach($restaurant->reviews as $review)
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-5">
                        De {{ $review->user->name }}
                    </div>
                    <div class="col-md-5">
                        {{ $review->updated_at }}
                    </div>
                    @if(Auth::check() && (Auth::user()->is_admin === 1) || Auth::check() && (Auth::user()->id ===
                    $review->user_id))
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
            </div>
            @include('reviews.show')
        </div>
    @endforeach
@else
    <p>Ce restaurant n'a aucune notes</p>
@endif

@if(Auth::check())
    @include('reviews.create')
@endif