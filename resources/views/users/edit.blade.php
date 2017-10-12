@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(Auth::check() && (Auth::user()->id === $user->id) || (Auth::user()->is_admin === 1))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Effectuer des modifications</h4>
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
                                    'class' => 'form-control'
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
                                    'class' => 'form-control'
                                    ])
                                !!}
                                </div>
                            </div>

                            <div class="text-center">
                                {!! Form::submit('Enregistrer modifications',
                                    ['class' => 'btn btn-primary'])
                                !!}
                            </div>

                            {!! Form::close() !!}

                            <br>

                            <div class="text-center">
                                <a href="{{ route('change_password', $user->id) }}">Modifier mot de passe</a>
                            </div>

                            <br>

                            @if(Auth::user()->id === $user->id)
                                <a href="{{ route('users.show', $user->id) }}">Retourner sur mon profil</a>
                            @elseif(Auth::user()->is_admin === 1)
                                <a href="{{ route('users.index') }}">Retourner sur la liste des utilisateurs</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection