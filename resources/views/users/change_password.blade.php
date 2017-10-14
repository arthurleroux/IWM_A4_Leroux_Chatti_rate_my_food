@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Modifier mon profil
                    </div>
                    <div class="panel-body">

                        {!! Form::model($user,
                        array(
                        'route' => array('edit_password', $user->id),
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

                        <div class="form-group">
                            {!! Form::label('password', 'Nouveau mot de passe', [
                            'class' => 'col-md-4 control-label'
                            ]) !!}
                            <div class="col-md-5">
                                {!! Form::password('password', [
                                'class' => 'form-control'
                                ])
                            !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirmer nouveau mot de passe', [
                            'class' => 'col-md-4 control-label'
                            ]) !!}
                            <div class="col-md-5">
                                {!! Form::password('password_confirmation',  [
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

                        <a href="{{ route('users.show', $user->id) }}">Retourner sur le profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection