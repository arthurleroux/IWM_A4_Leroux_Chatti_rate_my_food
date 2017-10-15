<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    {{ Form::label('', "Horaire d'ouverture", ['class' => 'control-label']) }}
</div>

@foreach($days as $day)
    <!-- {{ $day->day }} -->
    <div class="form-group{{ $errors->has($day->day) ? ' has-error' : '' }}">
        <div class="col-md-3">
            <p>
                {{ Form::checkbox($day->day, true,
                   $day->opening_days->first() && $day->opening_days->first()->is_open == 1 ? true : false)
                }}  {{ $day->day }}
                {{ Form::hidden($day->day .'_id', $day->id) }}
            </p>
        </div>

        <p id="opening__time">
            <input value="{{ $opening_days[$day->id - 1] ? $opening_days[$day->id - 1]->open_time : '9:00' }}" type="text" name="{{ $day->day }}_start_time"
                   class="time_start" /> -
            <input value="{{ $opening_days[$day->id - 1] ? $opening_days[$day->id - 1]->close_time : '18:00' }}" type="text" name="{{
            $day->day }}_end_time" class="time_end" />
        </p>

        <div class="col-md-12">
            @if ($errors->has($day->day))
                <span class="help-block">
                <strong>{{ $errors->first($day->day) }}</strong>
            </span>
            @endif
        </div>
    </div>
@endforeach

