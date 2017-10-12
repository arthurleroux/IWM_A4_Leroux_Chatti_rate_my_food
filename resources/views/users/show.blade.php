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


                            <div class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nom</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" readonly value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Adresse email</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" readonly value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Type de compte*</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" readonly value="{{ ($user->is_restaurant ? 'Restaurateur' : 'Client') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Type de compte*</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" readonly value="{{ ($user->is_admin ? 'Administrateur' : 'Classique') }}">
                                    </div>
                                </div>
                                * : non modifiable

                            </div>


                            {!! Form::model($user,
                                array(
                                    'route' => array('users.destroy', $user->id),
                                    'method' => 'DELETE'))
                            !!}


                            <div class="text-center">
                                <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}">Modifier profil</a>

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