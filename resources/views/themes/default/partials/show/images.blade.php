<div class="mb-2">
    <?php $img = $bookable->hasImage() ? $bookable->getImageUrl('') : url('/themes/default/assets/img/product-medium.jpg') ?>
    <img class="img-fluid" src="{{ $img  }}" id="bookable-image" />
</div>

<div class="thumbnail-container">
    @foreach($bookable->getMedia() as $media)
    <div class="thumbnail mr-1">
        <img class="mw-100" src="{{ $media->getUrl('thumbnail') }}"
             onclick="document.getElementById('bookable-image').setAttribute('src', '{{ $media->getUrl("") }}')"
             />
    </div>
    @endforeach
</div>
