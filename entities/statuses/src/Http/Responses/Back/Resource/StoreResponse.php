<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\SocialContest\Statuses\DTO\ItemData;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\StoreResponseContract;

/**
 * Class StoreResponse.
 */
class StoreResponse implements StoreResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected ItemsServiceContract $resourceService;

    /**
     * StoreResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
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
     *
     * @throws BindingResolutionException
     */
    public function toResponse($request)
    {
        $data = ItemData::fromRequest($request);

        $item = $this->resourceService->save($data);

        Session::flash('success', 'Статус «'.$item['name'].'» успешно создан');

        return response()->redirectToRoute('back.social-contest.statuses.edit', $item['id']);
    }
}
