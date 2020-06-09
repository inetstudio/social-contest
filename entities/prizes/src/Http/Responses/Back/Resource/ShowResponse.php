<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

class ShowResponse implements ShowResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $id = $request->route('prize');

        $resource = $this->resourceService->show($id);

        return resolve(
            'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract',
            compact('resource')
        );
    }
}
