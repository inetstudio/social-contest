<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\EditResponseContract;

class EditResponse implements EditResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $id = $request->route('prize', 0);

        $item = $this->resourceService->show($id);

        return response()->view(
            'admin.module.social-contest.prizes::back.pages.form',
            compact('item')
        );
    }
}
