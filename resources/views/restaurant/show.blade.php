@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h4>
                    {{ $restaurant->name }}
                </h4>
            </div>

            <div class="col s12">
                <b>Note : </b>
                @for ($i = 1; $i < 6; $i++)
                    <i class="fa fa-star" style="{{ $restaurant->average_rate >= $i ? 'color:#ec6f75;' : ''}}" aria-hidden="true"></i>
                @endfor
                -
                <b>Prix : </b>
                @for ($i = 1; $i < 6; $i++)
                    <i class="fa fa-eur" style="{{ $restaurant->average_price >= $i ? 'color:#ec6f75;' : ''}}" aria-hidden="true"></i>
                @endfor
            </div>
            <div class="col s12">
                <i class="fa fa-map-marker" aria-hidden="true"></i> {{$restaurant->address }}, {{$restaurant->city }} {{$restaurant->zip_code }}
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <!-- Slider main container -->
                @include('restaurant.partials.slider')
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#infos">Informations</a></li>
                    <li class="tab col s3"><a href="#reviews">Avis</a></li>
                </ul>
            </div>
            <div id="infos" class="col s12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            <b>Description : </b>{{ $restaurant->description }}
                        </p>

                        @if(Auth::check())
                            @if(Auth::user()->is_admin === 1 || Auth::user()->id == $restaurant->id)
                                <div class="row">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-2">
                                        <a href="{{ route('restaurant.edit', $restaurant->id) }}">
                                            <button class="btn btn-default">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::model($restaurant,
                                            array(
                                                'route' => array('restaurant.destroy', $restaurant->id),
                                                'method' => 'DELETE',
                                                'class' => 'delete'
                                            )
                                        ) !!}
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div id="reviews" class="col s12">
                @include('restaurant.partials.reviews')
            </div>
        </div>
    </div>
@endsection