@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Commentaire</h4>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(array(
                        'route' => 'reviews.store',
                        'method' => 'POST'
                        )) !!}

                        <div class="form-group">
                            {!! Form::label('rating', 'Note :') !!}
                            {!! Form::selectRange('rating', 0, 5) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Prix :') !!}
                            {!! Form::selectRange('price', 0, 5) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('comment', 'Commentaire') !!}
                            {!! Form::textarea('comment', '', [
                                'class' => 'form-control',
                                'placeholder' => 'Mon commentaire'
                                ])
                            !!}
                        </div>

                        <div class="text-center">
                            {!! Form::submit('Envoyer commentaire',
                                ['class' => 'btn btn-primary'])
                            !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection