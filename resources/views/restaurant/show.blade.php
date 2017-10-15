@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $restaurant->name }}
                </div>
                <div class="panel-body">
                    {{ $restaurant->description }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Avis
                </div>
                <div class="panel-body">

                    @if(count($restaurant->reviews) > 0)
                        @foreach($restaurant->reviews->where('status', 'accepted') as $review)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-5">
                                            De {{ $review->user->name }}
                                            {{ $review->status }}
                                        </div>
                                        <div class="col-md-5">
                                            {{ $review->updated_at }}
                                        </div>
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
                                </div>
                                @include('reviews.show')
                            </div>
                        @endforeach
                    @endif
                    @include('reviews.create')
                </div>
            </div>
        </div>
    </div>
@endsection