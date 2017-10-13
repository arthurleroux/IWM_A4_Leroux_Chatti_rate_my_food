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
                            @include('restaurant.partials.form')
                            @include('restaurant.partials.opening_time')

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
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
                        <div class="form-group{{ $errors->has('restaurant_img') ? ' has-error' : '' }}">
                            {{ Form::label('restaurant_img', 'Photo du restaurant', ['class' => 'col-md-4 control-label']) }}

                            <div class="col-md-6">
                                <div class="file-drop-area">
                                    <span class="fake-btn">Choose files</span>
                                    <span class="file-msg js-set-number">or drag and drop files here</span>
                                    {{ Form::file('add_picture', ['class' => 'file-input', 'multiple' => 'multiple']) }}
                                </div>

                                @if ($errors->has('restaurant_img'))
                                    <p class="help-block">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('restaurant_img') }}</strong>
                                        </span>
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 all__pictures"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection