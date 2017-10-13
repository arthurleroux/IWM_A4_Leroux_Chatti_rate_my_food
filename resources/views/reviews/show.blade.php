@extends('layouts.app')

@section('content')

    {{ $user->name }} a dit : {{ $review->comment }}

@endsection