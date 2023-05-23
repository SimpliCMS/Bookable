<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $bookable->name }} <span class="mr-2 font-weight-bold text-primary btn-lg">{{ format_price($bookable->price) }}</span></h5>
        {!! $bookable->description !!}

        <form action="{{ route('bookable.cart.add', $bookable) }}" method="post" class="mb-4">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-success btn-lg" @if(!$bookable->price) disabled @endif>Add to cart</button>
        </form>
    </div>
</div>

