<?php

namespace InetStudio\SocialContest\Prizes\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\EditRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\ShowRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\IndexRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\StoreRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\ResourceControllerContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\CreateRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\UpdateRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\EditResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\DestroyRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\StoreResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\CreateResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\UpdateResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Class ResourceController.
 */
class ResourceController extends Controller implements ResourceControllerContract
{
    /**
     * Список объектов.
     *
     * @param  IndexRequestContract  $request
     * @param  IndexResponseContract  $response
     *
     * @return IndexResponseContract
     */
    public function index(IndexRequestContract $request, IndexResponseContract $response): IndexResponseContract
    {
        return $response;
    }

    /**
     * Создание объекта.
     *
     * @param  CreateRequestContract  $request
     * @param  CreateResponseContract  $response
     *
     * @return CreateResponseContract
     */
    public function create(CreateRequestContract $request, CreateResponseContract $response): CreateResponseContract
    {
        return $response;
    }

    /**
     * Сохранение объекта.
     *
     * @param  StoreRequestContract  $request
     * @param  StoreResponseContract  $response
     *
     * @return StoreResponseContract
     */
    public function store(StoreRequestContract $request, StoreResponseContract $response): StoreResponseContract
    {
        return $response;
    }

    /**
     * Отображение объекта.
     *
     * @param  ShowRequestContract  $request
     * @param  ShowResponseContract  $response
     *
     * @return ShowResponseContract
     */
    public function show(ShowRequestContract $request, ShowResponseContract $response): ShowResponseContract
    {
        return $response;
    }

    /**
     * Редактирование объекта.
     *
     * @param  EditRequestContract  $request
     * @param  EditResponseContract  $response
     *
     * @return EditResponseContract
     */
    public function edit(EditRequestContract $request, EditResponseContract $response): EditResponseContract
    {
        return $response;
    }

    /**
     * Обновление объекта.
     *
     * @param  UpdateRequestContract  $request
     * @param  UpdateResponseContract  $response
     *
     * @return UpdateResponseContract
     */
    public function update(UpdateRequestContract $request, UpdateResponseContract $response): UpdateResponseContract
    {
        return $response;
    }

    /**
     * Удаление объекта.
     *
     * @param  DestroyRequestContract  $request
     * @param  DestroyResponseContract  $response
     *
     * @return DestroyResponseContract
     */
    public function destroy(DestroyRequestContract $request, DestroyResponseContract $response): DestroyResponseContract
    {
        return $response;
    }
}
