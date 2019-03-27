@if ($item->social->hasMedia('media'))
    @if ($item->social->media_type == 'video')
        <a data-fancybox data-width="640" data-height="360" href="{{ url($item->social->getFirstMediaUrl('media')) }}">
            <img class="card-img-top img-fluid" src="{{ url($item->social->getFirstMediaUrl('cover', 'cover_admin_'.$conversion)) }}" />
        </a>
    @endif

    @if ($item->social->media_type == 'photo')
        <a data-fancybox href="{{ url($item->social->getFirstMediaUrl('media')) }}">
            <img src="{{ url($item->social->getFirstMediaUrl('media', 'preview_admin_'.$conversion)) }}" class=" m-b-md img-fluid" alt="post_image">
        </a>
    @endif

    @if ($item->social->media_type == 'carousel')
        @php
            $media = $item->social->getMedia('media')
        @endphp
        @foreach ($media as $mediaItem)
            @if ($mediaItem->mime_type == 'image/jpeg')
                <a data-fancybox="carousel-{{ $item['id'] }}" href="{{ url($mediaItem->getUrl()) }}" {!! (! $loop->first) ? 'style="display: none"' : '' !!}>
                    <img src="{{ url($mediaItem->getUrl('preview_admin_'.$conversion)) }}" class=" m-b-md img-fluid" alt="post_image">
                </a>
            @else
                @php
                    $coverId = $mediaItem->getCustomProperty('cover');
                    $cover = \Spatie\MediaLibrary\Models\Media::find($coverId)->first();
                @endphp
                <a data-fancybox="carousel-{{ $item['id'] }}" data-width="640" data-height="360" href="{{ url($mediaItem->getUrl()) }}">
                    <img class="card-img-top img-fluid" src="{{ url($cover->getUrl('cover_admin_'.$conversion)) }}" />
                </a>
            @endif
        @endforeach
    @endif
@endif
