@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @foreach($users as $profile)
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>{{ $profile->name }}</h4>
                            <div class="text-right">
                                @if($profile->isAdmin == 0)
                                    <h5>Simple utilisateur </h5>
                                @elseif($profile->isAdmin == 1)
                                    <h5>Administrateur </h5>
                                @endif
                            </div>
                        </div>

                        <div class="panel-body">
                            {!! Form::model($profile,
                            array(
                                'route' => array('profile.destroy', $profile->id),
                                'method' => 'DELETE'))
                            !!}


                            <div class="text-center">

                                {!! Form::submit('Supprimer utilisateur', ['class' => 'btn btn-danger']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection