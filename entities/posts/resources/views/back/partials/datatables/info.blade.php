@inject('statusesService', 'InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract')

@php
    $blockStatus = $statusesService->getStatusByType('block');
@endphp

<p><strong>Социальная сеть:</strong> {{ $item['social']['social_name'] }}</p>
<p><strong>Тип поста:</strong> {{ $item['social']['media_type'] }}</p>
<p><strong>Пользователь:</strong> <a href="{{ $item['social']['user']['url'] }}" target="_blank">{{ $item['social']['user']['nickname'] }}</a>
    @if ($blockStatus && $blockStatus->alias and $item['status'] != $blockStatus->alias)
        <button class="btn btn-white btn-xs post-block" title="Заблокировать" data-target="{{ route('back.social-contest.posts.moderate', [$item['id'], $blockStatus->alias]) }}"><i class="fa fa-minus-circle"></i></button>
    @endif
</p>
<p><strong>Пост:</strong> <a href="{{ $item['social']['url'] }}" target="_blank">Перейти</a></p>
<p><strong>ID поста на сайте:</strong> <span id="hash-{{ $item['id'] }}">{{ $item['hash'] }}</span> <button class="btn btn-white btn-xs clipboard" data-clipboard-target="#hash-{{ $item['id'] }}"><i class="fa fa-copy"></i></button></p>
<p><strong>Содержимое:</strong><br/>{!! $item['social']['caption'] !!}</p>
