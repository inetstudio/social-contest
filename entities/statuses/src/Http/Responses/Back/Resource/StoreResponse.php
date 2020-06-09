<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use Illuminate\Support\Facades\Session;
use InetStudio\SocialContest\Statuses\DTO\Back\Resource\Save\ItemData;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\StoreResponseContract;

class StoreResponse implements StoreResponseContract
{

    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $data = ItemData::fromRequest($request);

        $item = $this->resourceService->save($data);

        Session::flash('success', 'Статус «'.$item['name'].'» успешно создан');

        return response()->redirectToRoute('back.social-contest.statuses.edit', $item['id']);
    }
}
