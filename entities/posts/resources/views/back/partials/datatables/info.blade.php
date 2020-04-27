@inject('statusesService', 'InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract')

@php
    $blockStatus = $statusesService->getItemsByType('blocked')->first();
@endphp

<p><strong>Социальная сеть:</strong> {{ $item['social']['social_name'] }}</p>
<p><strong>Тип поста:</strong> {{ $item['social']['media_type'] }}</p>
<p><strong>Пользователь:</strong> <a href="{{ $item['social']['user']['url'] }}" target="_blank">{{ $item['social']['user']['nickname'] }}</a>
    @if ($blockStatus && $item['status'] != $blockStatus['alias'])
        <button class="btn btn-white btn-xs post-block" title="Заблокировать" data-target="{{ route('back.social-contest.posts.moderate', [$item['id'], $blockStatus->alias]) }}"><i class="fa fa-minus-circle"></i></button>
    @endif
</p>
<p><strong>Пост:</strong> <a href="{{ $item['social']['url'] }}" target="_blank">Перейти</a></p>
<p><strong>ID поста на сайте:</strong> <span id="uuid-{{ $item['id'] }}">{{ $item['uuid'] }}</span> <button class="btn btn-white btn-xs clipboard" data-clipboard-target="#uuid-{{ $item['id'] }}"><i class="fa fa-copy"></i></button></p>
<p><strong>Содержимое:</strong><br/>{!! $item['social']['caption'] !!}</p>
