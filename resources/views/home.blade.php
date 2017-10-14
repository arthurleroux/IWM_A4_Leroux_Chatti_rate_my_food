@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row">
                @foreach($restaurants as $restaurant)
                    <div class="col-sm-3">
                        <a href="{{ route('restaurant.show', $restaurant->id) }}"><h4 class=""> {{ $restaurant->name }} </h4></a>
                        <p class="card-text">Here are the top resources for all things related to the Sun.</p>
                        <p>{{ $restaurant->address }}, {{ $restaurant->city }} {{ $restaurant->zip_code }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
