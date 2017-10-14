<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Avis en attente
        </div>
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
                            <div class="col-md-5">
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
                            <div class="col-md-1">
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

    <div class="panel panel-default">
        <div class="panel-heading">
            Avis rejetés
        </div>
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
                            <div class="col-md-5">
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
                            <div class="col-md-1">
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