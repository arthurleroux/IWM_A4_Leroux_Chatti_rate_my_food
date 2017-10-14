<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample">
            Laisser un avis
        </a>
    </div>
    <div class="collapse" id="review">
        <div class="panel-body">
            {!! Form::open(array(
                'route' => 'reviews.store',
                'method' => 'POST'
                )) !!}

            {{ Form::hidden('restaurant_id', $restaurant->id) }}
            {{ Form::hidden('user_id', Auth::user()->id) }}

            <div class="form-group">
                {!! Form::label('rating', 'Note (/5) :') !!}
                {!! Form::selectRange('rating', 0, 5) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Prix (/5) :') !!}
                {!! Form::selectRange('price', 0, 5) !!}
            </div>

            <div class="form-group">
                {!! Form::label('comment', 'Commentaire :') !!}
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