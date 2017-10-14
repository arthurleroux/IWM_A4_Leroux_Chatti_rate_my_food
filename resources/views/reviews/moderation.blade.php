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
                            <div class="col-md-6">
                                <a data-toggle="collapse" href="#{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}">
                                    De  : {{ $review->user->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                   <div class="collapse" id="{{ $i }}">
                        @include('reviews.show')
                   </div>
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
                            <div class="col-md-6">
                                <a data-toggle="collapse" href="#{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}">
                                    De  : {{ $review->user->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="{{ $i }}">
                        @include('reviews.show')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>