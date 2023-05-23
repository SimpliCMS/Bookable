@extends('layouts.master')
@section('title')
{{ $bookable->name }}
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-5">
            @include("bookable::partials.show.images", ['bookable' => $bookable])
        </div>

        <div class="col-12 col-lg-8 col-xl-7">
            @include("bookable::partials.show.info", ['bookable' => $bookable])
        </div>
    </div>
    @endsection

