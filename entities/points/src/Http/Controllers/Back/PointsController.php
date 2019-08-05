<?php

namespace InetStudio\SocialContest\Points\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Points\Contracts\Http\Requests\Back\SavePointRequestContract;
use InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back\PointsControllerContract;
use InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\FormResponseContract;
use InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\SaveResponseContract;
use InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\IndexResponseContract;
use InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\DestroyResponseContract;

/**
 * Class PointsController.
 */
class PointsController extends Controller implements PointsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * PointsController constructor.
     */
    public function __construct()
    {
        $this->services['points'] = app()->make('InetStudio\SocialContest\Points\Contracts\Services\Back\PointsServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Points\Contracts\Services\Back\PointsDataTableServiceContract');
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
        $item = $this->services['points']->getItemByID();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SavePointRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SavePointRequestContract $request): SaveResponseContract
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
        $item = $this->services['points']->getItemByID($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SavePointRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SavePointRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SavePointRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SavePointRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['points']->save($request, $id);

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
        $result = $this->services['points']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
