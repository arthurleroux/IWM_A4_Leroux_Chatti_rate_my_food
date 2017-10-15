<div class="container">
    <div class="panel panel-default">
        <a data-toggle="collapse" href="#restaurant_pening" aria-expanded="false" aria-controls="restaurant_pening">
            <div class="panel-heading">
                Restaurants en attente ({{ count($restaurant_pending) }})
            </div>
        </a>
        <div class="collapse" id="restaurant_pening">
            <div class="panel-body">
                @php
                $i = 0
                @endphp
                @foreach($restaurant_pending as $restaurant)
                    @php
                    $i++
                    @endphp
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Restaurant : </b>{{ $restaurant->name }}
                                </div>
                                <div class="col-md-4">
                                    <b>Propriétaire : </b><a href="{{ route('users.show', $restaurant->user_id) }}">{{ $restaurant->user->name }}</a>
                                </div>
                                <div class="col-md-2">
                                    {!! Form::model($restaurant,
                                        array(
                                            'route' => array('restaurant.change_status', $restaurant->id),
                                            'method' => 'PUT')
                                        )
                                    !!}
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="" disabled selected>Action</option>
                                        <option value="accepted">Accepter</option>
                                        <option value="rejected">Rejeter</option>
                                    </select>

                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::model($restaurant,
                                        array(
                                            'route' => array('restaurant.destroy', $restaurant->id),
                                            'method' => 'DELETE'))
                                    !!}
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <a data-toggle="collapse" href="#restaurant_rejected" aria-expanded="false" aria-controls="restaurant_rejected">
            <div class="panel-heading">
                Restaurants rejetés ({{ count($restaurant_rejected) }})
            </div>
        </a>
        <div class="collapse" id="restaurant_rejected">
            <div class="panel-body">
                @php
                $i = 0
                @endphp
                @foreach($restaurant_rejected as $restaurant)
                    @php
                    $i++
                    @endphp
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Restaurant : </b>{{ $restaurant->name }}
                                </div>
                                <div class="col-md-4">
                                    <b>Propriétaire : </b><a href="{{ route('users.show', $restaurant->user_id) }}">{{ $restaurant->user->name }}</a>
                                </div>
                                <div class="col-md-2">
                                    {!! Form::model($restaurant,
                                        array(
                                            'route' => array('restaurant.change_status', $restaurant->id),
                                            'method' => 'PUT')
                                        )
                                    !!}
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="" disabled selected>Action</option>
                                        <option value="accepted">Accepter</option>
                                        <option value="rejected">Rejeter</option>
                                    </select>

                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::model($restaurant,
                                        array(
                                            'route' => array('restaurant.destroy', $restaurant->id),
                                            'method' => 'DELETE'))
                                    !!}
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>