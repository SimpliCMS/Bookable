@extends('appshell::layouts.private')

@section('title')
    {{ $bookable->name }}
@stop

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-4 mb-3">
            @component('appshell::widgets.card_with_icon', [
                    'icon' => $bookable->is_active ? 'product' : 'product-off',
                    'type' => $bookable->is_active ? 'success' : 'warning'
            ])
                {{ $bookable->name }}
                @if (!$bookable->is_active)
                    <small>
                        <span class="badge badge-secondary">
                            {{ __('inactive') }}
                        </span>
                    </small>
                @endif
                @slot('subtitle')
                    {{ $bookable->sku }}
                @endslot
            @endcomponent
        </div>

        <div class="col-sm-6 col-md-5 mb-3">
            @component('appshell::widgets.card_with_icon', [
                    'icon' => 'time',
                    'type' => 'info'
            ])
                {{ $bookable->state }}

                @slot('subtitle')
                    {{ __('Updated') }}
                    {{ show_datetime($bookable->updated_at) }}
                    |
                    {{ __('Created at') }}
                    {{ show_datetime($bookable->created_at) }}
                @endslot
            @endcomponent
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            @component('appshell::widgets.card_with_icon', ['icon' => 'bag'])
                {{ $bookable->units_sold ?: '0' }}
                {{ __('units sold') }}
                @slot('subtitle')
                    @if ($bookable->last_sale_at)
                        {{ __('Last sale at') }}
                        {{ show_datetime($bookable->last_sale_at) }}
                    @else
                        {{ __('No sales were registered') }}
                    @endif
                @endslot
            @endcomponent
        </div>

        <div class="col-12 col-md-6 col-lg-8 col-xl-9 mb-3">

        </div>

        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
            @include('admin::partials.media._index', ['model' => $bookable])
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            @can('edit products')
            <a href="{{ route('bookables.admin.edit', $bookable) }}" class="btn btn-outline-primary">{{ __('Edit service') }}</a>
            @endcan

            @can('delete products')
                {!! Form::open(['route' => ['bookables.admin.destroy', $bookable], 'method' => 'DELETE', 'class' => "float-right"]) !!}
                <button class="btn btn-outline-danger">
                    {{ __('Delete product') }}
                </button>
                {!! Form::close() !!}
            @endcan

        </div>
    </div>

@stop