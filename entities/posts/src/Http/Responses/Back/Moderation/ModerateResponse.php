<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Moderation;

use InetStudio\SocialContest\Posts\DTO\Back\Moderation\Moderate\ItemData;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Moderation\ModerateResponseContract;

class ModerateResponse implements ModerateResponseContract
{
    protected ModerateServiceContract $moderateService;

    public function __construct(ModerateServiceContract $moderateService)
    {
        $this->moderateService = $moderateService;
    }

    public function toResponse($request)
    {
        $data = ItemData::fromRequest($request);

        $resource = collect([$this->moderateService->moderate($data)]);

        return resolve(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemsCollectionContract',
            compact('resource')
        );
    }
}
