@extends('layouts.master')
@section('title')
Bookable Services
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-3">

        </div>
        <div class="col-12 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($bookables->sortByDesc('created_at') as $bookable)
                        @if ($bookable->is_active)
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-3">
                                <a href="{{ route('bookable.show', $bookable->slug) }}"><img src="{{ $bookable->getMedia('default')[0]->getUrl() }}" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                    <p class="card-text"><a href="{{ route('bookable.show', $bookable->slug) }}">{{ Str::limit($bookable->name, 50) }}</a></p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
