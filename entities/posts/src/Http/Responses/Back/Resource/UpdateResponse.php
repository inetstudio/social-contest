<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Posts\DTO\Back\Resource\Update\ItemData;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;

class UpdateResponse implements UpdateResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $data = ItemData::fromRequest($request);

        $item = $this->resourceService->update($data);

        return resolve(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Update\ItemResourceContract',
            [
                'resource' => $item,
            ]
        );
    }
}
