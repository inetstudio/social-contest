<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Posts\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

class ShowResponse implements ShowResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $id = $request->route('post');

        $resource = $this->resourceService->show($id);

        return resolve(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract',
            compact('resource')
        );
    }
}
