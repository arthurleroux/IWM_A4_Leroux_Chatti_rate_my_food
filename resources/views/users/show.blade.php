@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Auth::check() && Auth::user()->id == $user->id)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Mes informations</h4>
                        </div>
                        <div class="panel-body">

                            {!! Form::model($user,
                            array(
                            'route' => array('users.update', $user->id),
                            'method' => 'PUT',
                            'class' => 'form-horizontal'
                            )) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Nom', [
                                'class' => 'col-md-4 control-label',
                                ]) !!}
                                <div class="col-md-5">
                                    {!! Form::text('name', old('name'), [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly'
                                    ])
                                !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Adresse email', [
                                'class' => 'col-md-4 control-label'
                                ]) !!}
                                <div class="col-md-5">
                                    {!! Form::email('email', old('email'), [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly'
                                    ])
                                !!}
                                </div>
                            </div>

                            {!! Form::close() !!}

                            {!! Form::model($user,
                                array(
                                    'route' => array('users.destroy', $user->id),
                                    'method' => 'DELETE'))
                            !!}


                            <div class="text-center">
                                <a class="btn btn-warning" href="{{ route('users.edit', Auth::user()->id) }}">Modifier mon profil</a>

                                {!! Form::submit('Supprimer mon profil', ['class' => 'btn btn-danger']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection