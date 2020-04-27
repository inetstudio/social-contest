<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\SocialContest\Statuses\DTO\ItemData;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;

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
     *
     * @throws BindingResolutionException
     */
    public function toResponse($request)
    {
        $data = ItemData::fromRequest($request);

        $item = $this->resourceService->save($data);

        Session::flash('success', 'Статус «'.$item['name'].'» успешно обновлен');

        return response()->redirectToRoute('back.social-contest.statuses.edit', $item['id']);
    }
}
