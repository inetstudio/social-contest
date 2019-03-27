@inject('statusesService', 'InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract')

@php
    $statuses = $statusesService->getAllItems()->pluck('name', 'alias')->toArray();
@endphp

<div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-xs btn-default dropdown-toggle" aria-expanded="false">Статус</button>
    <ul class="dropdown-menu">
        @foreach ($statuses as $statusAlias => $statusName)
            @if ($statusAlias != $item['status']['alias'])
                <li>
                    <a class="post-moderate" href="#" data-target="{{ route('back.social-contest.posts.moderate', ['id' => $item['id'], 'statusAlias' => $statusAlias]) }}">{{ $statusName }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
