<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Class DestroyResponse.
 */
class DestroyResponse implements DestroyResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected ItemsServiceContract $resourceService;

    /**
     * DestroyResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при удалении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $id = $request->route('status');

        $count = $this->resourceService->destroy($id);

        return response()->json(
            [
                'success' => ($count > 0),
            ]
        );
    }
}
