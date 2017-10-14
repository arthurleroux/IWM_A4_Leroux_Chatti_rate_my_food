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
                        @foreach($restaurant->reviews as $review)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    De {{ $review->user->name }}
                                    <br>
                                    {{ $review->updated_at }}
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