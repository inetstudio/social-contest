<?php

namespace InetStudio\SocialContest\Tags\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back\TagsControllerContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Tags\IndexResponseContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Tags\DestroyResponseContract;

/**
 * Class TagsController.
 */
class TagsController extends Controller implements TagsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->services['tags'] = app()->make('InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['tags']->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveTagRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveTagRequestContract $request): SaveResponseContract
    {
        return $this->save($request);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(int $id = 0): FormResponseContract
    {
        $item = $this->services['tags']->getItemById($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveTagRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveTagRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveTagRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveTagRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['tags']->save($request, $id);

        return app()->makeWith(SaveResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['tags']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
