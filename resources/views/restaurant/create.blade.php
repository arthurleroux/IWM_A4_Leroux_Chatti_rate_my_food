@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Enregistrer un restaurant</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['restaurant.store'], 'files' => 'true']) !!}
                            @include('restaurant.partials.form')

                            <div class="form-group{{ $errors->has('restaurant_img') ? ' has-error' : '' }}">
                                {{ Form::label('restaurant_img', 'Photo du restaurant', ['class' => 'col-md-4 control-label']) }}

                                <div class="col-md-6">
                                    {{ Form::file('restaurant_img') }}
                                    <img src="" id="restaurant_img_tag" width="200px" />

                                    @if ($errors->has('restaurant_img'))
                                        <p class="help-block">
                                            <span class="help-block">
                                                <strong>{{ $errors->first('restaurant_img') }}</strong>
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enregistrer mon restaurant
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection