<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\CreateResponseContract;

class CreateResponse implements CreateResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $item = $this->resourceService->create();

        return response()->view(
            'admin.module.social-contest.prizes::back.pages.form',
            compact('item')
        );
    }
}
