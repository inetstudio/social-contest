@inject('statusesService', 'InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract')

@php
    $statuses = $statusesService->getModel()->all()->pluck('name', 'alias')->toArray();
    $setReasonStatuses = $statusesService->getItemsByType('reason');
@endphp

<div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-xs btn-default dropdown-toggle" aria-expanded="false">Статус</button>
    <ul class="dropdown-menu">
        @foreach ($statuses as $statusAlias => $statusName)
            @if ($statusAlias != $item['status']['alias'])
                <li>
                    <a class="post-moderate" href="{{ route('back.social-contest.posts.moderate', ['id' => $item['id'], 'alias' => $statusAlias]) }}" {{ ($setReasonStatuses->keyBy('alias')->has($statusAlias)) ? 'data-reason' : '' }}>{{ $statusName }}</a>
                </li>
            @endif
        @endforeach
    </ul>

    <button class="btn btn-default show-social_post" type="button" data-url="{{ route('back.social-contest.posts.show', [$item['id']]) }}">
        <i class="fa fa-photo-video"></i>
    </button>
</div>
