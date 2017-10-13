<!-- <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('restaurant.store') }}"> -->
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {{ Form::label('name', 'Nom du restaurant', ['class' => 'control-label']) }}

        {{ Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) }}

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {{ Form::label('description', 'Description', ['class' => 'control-label']) }}

        {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) }}

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
     </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        {{ Form::label('address', 'Adresse', ['class' => 'control-label']) }}

        {{ Form::text('address', old('address'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) }}

        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
        {{ Form::label('city', 'Ville', ['class' => 'control-label']) }}

        {{ Form::text('city', old('city'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) }}

        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
        {{ Form::label('zip_code', 'Code postal', ['class' => 'control-label']) }}

        {{ Form::number('zip_code', old('zip_code'),
            [
                'class' => 'form-control',
                'required' => 'required',
                'autofocus' => 'autofocus',
                'max' => '99999'
            ])
        }}

        @if ($errors->has('zip_code'))
            <span class="help-block">
                <strong>{{ $errors->first('zip_code') }}</strong>
            </span>
        @endif
    </div>
<!-- </form> -->