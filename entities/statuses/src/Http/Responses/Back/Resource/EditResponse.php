<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\EditResponseContract;

class EditResponse implements EditResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $id = $request->route('status', 0);

        $item = $this->resourceService->show($id);

        return response()->view('admin.module.social-contest.statuses::back.pages.form', compact('item'));
    }
}
