<div class="container">
    <div class="panel panel-default">
        <a data-toggle="collapse" href="#reviews_pending" aria-expanded="false" aria-controls="reviews_pending">
            <div class="panel-heading">
                Avis en attente ({{ count($reviews_pending) }})
            </div>
        </a>
        <div class="collapse" id="reviews_pending">
            <div class="panel-body">
                @php
                $i = 0
                @endphp
                @foreach($reviews_pending as $review)
                    @php
                    $i++
                    @endphp
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Restaurant : </b><a href="{{ route('restaurant.show', $review->restaurant_id) }}">{{ $review->restaurant->name }}</a>
                                </div>
                                <div class="col-md-4">
                                    <b>Auteur : </b><a href="{{ route('users.show', $review->user_id) }}">{{ $review->user->name }}</a>
                                </div>
                                <div class="col-md-2">
                                    {!! Form::model($review,
                                        array(
                                            'route' => array('reviews.change_status', $review->id),
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
                            </div>
                        </div>
                        @include('reviews.show')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <a data-toggle="collapse" href="#reviews_rejected" aria-expanded="false" aria-controls="reviews_rejected">
            <div class="panel-heading">
                Avis rejetés ({{ count($reviews_rejected) }})
            </div>
        </a>
        <div class="collapse" id="reviews_rejected">
            <div class="panel-body">
                @php
                $i = 0
                @endphp
                @foreach($reviews_rejected as $review)
                    @php
                    $i++
                    @endphp
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Restaurant : </b>{{ $review->restaurant->name }}
                                </div>
                                <div class="col-md-4">
                                    <b>Auteur : </b>{{ $review->user->name }}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::model($review,
                                        array(
                                            'route' => array('reviews.change_status', $review->id),
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
                            </div>
                        </div>
                        @include('reviews.show')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>