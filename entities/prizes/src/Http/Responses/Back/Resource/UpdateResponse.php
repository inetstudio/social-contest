<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\SocialContest\Prizes\DTO\ItemData;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;

/**
 * Class UpdateResponse.
 */
class UpdateResponse implements UpdateResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected ItemsServiceContract $resourceService;

    /**
     * UpdateResponse constructor.
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

        Session::flash('success', 'Приз «'.$item['name'].'» успешно обновлен');

        return response()->redirectToRoute('back.social-contest.prizes.edit', $item['id']);
    }
}
