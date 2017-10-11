<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('restaurant.store') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nom du restaurant</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <textarea id="description" class="form-control" name="description" value="{{ old('description') }}" required
                      cols="30"
                      rows="10">
            </textarea>

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Adresse</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" required>

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
        <label for="city" class="col-md-4 control-label">Ville</label>

        <div class="col-md-6">
            <input id="city" type="text" class="form-control" name="city" required>

            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
        <label for="zip_code" class="col-md-4 control-label">Code postal</label>

        <div class="col-md-6">
            <input id="zip_code" type="text" class="form-control" name="zip_code" required>

            @if ($errors->has('zip_code'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="restaurant_img" class="col-md-4 control-label">Photo du restaurant</label>
        <div class="col-md-6">
            <input type="file" name="restaurant_img" id="restaurant_img">
            <img src="" id="restaurant_img_tag" width="200px" />
            <p class="help-block">Example block-level help text here.</p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Enregistrer mon restaurant
            </button>
        </div>
    </div>
</form>