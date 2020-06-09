<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

class ShowResponse implements ShowResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $id = $request->route('status');

        $item = $this->resourceService->show($id);

        return response()->json($item->toArray());
    }
}
