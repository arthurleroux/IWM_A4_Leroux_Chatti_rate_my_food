@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Modifier commentaire
                    </div>

                    <div class="panel-body">
                        {!! Form::model($review,
                        array(
                        'route' => array('reviews.update', $review->id),
                        'method' => 'PUT'
                        )) !!}

                        <div class="form-group">
                            {!! Form::label('rating', 'Note :') !!}
                            {!! Form::selectRange('rating', 0, 5, old('rating')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Prix :') !!}
                            {!! Form::selectRange('price', 0, 5, old('price')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('comment', 'Commentaire') !!}
                            {!! Form::textarea('comment', old('comment'), [
                                'class' => 'form-control',
                                'placeholder' => 'Mon commentaire'
                                ])
                            !!}
                        </div>

                        <div class="text-center">
                            {!! Form::submit('Enregistrer modification',
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