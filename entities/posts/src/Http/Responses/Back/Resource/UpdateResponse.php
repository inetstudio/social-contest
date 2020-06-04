<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\SocialContest\Posts\DTO\ItemData;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract;

class UpdateResponse implements UpdateResponseContract
{
    protected ItemsServiceContract $resourceService;

    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $data = ItemData::prepareData($request->all());

        $item = $this->resourceService->save($data);

        return app()->make(
            ItemResourceContract::class,
            [
                'resource' => $item,
            ]
        );
    }
}
