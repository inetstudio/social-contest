<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use Illuminate\Support\Facades\Session;
use InetStudio\SocialContest\Prizes\DTO\Back\Resource\Save\ItemData;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\StoreResponseContract;

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

        Session::flash('success', 'Приз «'.$item['name'].'» успешно создан');

        return response()->redirectToRoute('back.social-contest.prizes.edit', $item['id']);
    }
}
