<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\SocialContest\Prizes\DTO\ItemData;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\StoreResponseContract;

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
     */
    public function toResponse($request)
    {
        $data = ItemData::prepareData($request->all());

        $item = $this->resourceService->save($data);

        Session::flash('success', 'Приз «'.$item['name'].'» успешно создан');

        return response()->redirectToRoute('back.social-contest.prizes.edit', $item['id']);
    }
}
