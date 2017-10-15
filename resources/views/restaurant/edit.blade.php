@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> {{ $restaurant->name }} </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"> Informations </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! Form::model(
                            $restaurant,
                            [
                                'method' => 'PUT',
                                'route' => ['restaurant.update', $restaurant->id],
                                'files' => 'true',
                                'class' => ''
                            ])
                        !!}
                            <input type="hidden" id="restaurant_id" data-restaurant_id="{{$restaurant->id}}">

                            @include('restaurant.partials.form')
                            @include('restaurant.partials.opening_time')

                            <div class="form-group">
                                <div class="col s12 center-align">
                                    <button type="submit" class="btn btn-primary">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"> Photos </div>

                    <div class="panel-body">
                        @include('restaurant.partials.picture_upload')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection