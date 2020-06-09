<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

class DestroyResponse implements DestroyResponseContract
{
    protected ResourceServiceContract $resourceService;

    public function __construct(ResourceServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function toResponse($request)
    {
        $id = $request->route('prize');

        $count = $this->resourceService->destroy($id);

        return response()->json(
            [
                'success' => ($count > 0),
            ]
        );
    }
}
