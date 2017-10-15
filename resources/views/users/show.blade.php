@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Mes informations
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
                                <label class="col-md-4 control-label">Droits*</label>
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

                            {!! Form::submit('Supprimer profil', ['class' => 'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}

                        <br>

                        @if(Auth::user()->is_admin === 1)
                        <a href="{{ route('users.index') }}">Retourner sur la liste des utilisateurs</a>
                        @endif
                    </div>
                </div>

                @if(count($user->reviews->where('status', 'accepted')) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mes commentaires
                        </div>
                        <div class="panel-body">
                            @foreach($reviews as $review)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Restaurant : <a href="{{ route('restaurant.show', $review->restaurant->id) }}">{{ $review->restaurant->name }}</a>
                                            </div>
                                            <div class="col-md-4">
                                                {{ $review->updated_at }}
                                            </div>
                                            @if(Auth::check() && (Auth::user()->is_admin === 1) || (Auth::user()->id === $review->user_id))
                                                <div class="col-md-2">
                                                    <a href="{{ route('reviews.edit', $review->id) }}">
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    {!! Form::model($review,
                                                        array(
                                                            'route' => array('reviews.destroy', $review->id),
                                                            'method' => 'DELETE'))
                                                    !!}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @include('reviews.show')
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($user->is_restaurant && count($user->restaurants->where('status', 'accepted')) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mes restaurants
                        </div>
                        <div class="panel-body">
                            @foreach($restaurants as $restaurant)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <a href="{{ route('restaurant.show', $restaurant->id) }}">{{ $restaurant->name }}</a>
                                            </div>
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
                                    </div>
                                    <div class="panel-body">
                                        {{ $restaurant->description }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection