<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    {{ Form::label('', "Horaire d'ouverture", ['class' => 'control-label']) }}
</div>

@foreach($days as $day)
    <!-- {{ $day->day }} -->
    <div class="form-group{{ $errors->has($day->day) ? ' has-error' : '' }}">
        @if($opening_days->count() > $day->id - 1)
            <div class="col s5">
                <div class="switch">
                    <label>
                        {{ Form::checkbox($day->day, true, $opening_days[$day->id - 1] && $opening_days[$day->id - 1]->is_open == 1 ? true :
                        false) }}
                        <span class="lever"></span>
                    </label>
                    {{ Form::label($day->day, $day->day, ['class' => 'control-label']) }}
                    {{ Form::hidden($day->day .'_id', $day->id) }}
                </div>
            </div>

            <div class="input-field col s3">
                <p id="opening__time">
                    <input value="{{ $opening_days[$day->id - 1] ? $opening_days[$day->id - 1]->open_time : '9:00' }}" type="text" name="{{ $day->day }}_start_time"
                           class="time_start" />
                </p>
            </div>
            <div class="input-field col s1">
                -
            </div>

            <div class="input-field col s3">
                <p id="opening__time">
                    <input value="{{ $opening_days[$day->id - 1] ? $opening_days[$day->id - 1]->close_time : '18:00' }}" type="text" name="{{ $day->day
                 }}_end_time" class="time_end" />
                </p>
            </div>

            <div class="col-md-12">
                @if ($errors->has($day->day))
                    <span class="help-block">
                        <strong>{{ $errors->first($day->day) }}</strong>
                    </span>
                @endif
            </div>
        @else
            <div class="col s5">
                <div class="switch">
                    <label>
                        {{ Form::checkbox($day->day, true, false) }}
                        <span class="lever"></span>
                    </label>
                    {{ Form::label($day->day, $day->day, ['class' => 'control-label']) }}
                    {{ Form::hidden($day->day .'_id', $day->id) }}
                </div>
            </div>

            <div class="input-field col s3">
                <p id="opening__time">
                    <input value="9:00" type="text" name="{{ $day->day }}_start_time" class="time_start" />
                </p>
            </div>
            <div class="input-field col s1">
                -
            </div>

            <div class="input-field col s3">
                <p id="opening__time">
                    <input value="18:00" type="text" name="{{ $day->day }}_end_time" class="time_end" />
                </p>
            </div>

            <div class="col-md-12">
                @if ($errors->has($day->day))
                    <span class="help-block">
                        <strong>{{ $errors->first($day->day) }}</strong>
                    </span>
                @endif
            </div>
        @endif

    </div>
@endforeach

