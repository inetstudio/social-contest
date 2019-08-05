<?php

namespace InetStudio\SocialContest\Stages\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Stages\Contracts\Http\Requests\Back\SaveStageRequestContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back\StagesControllerContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\FormResponseContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\SaveResponseContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\IndexResponseContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\DestroyResponseContract;

/**
 * Class StagesController.
 */
class StagesController extends Controller implements StagesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * StagesController constructor.
     */
    public function __construct()
    {
        $this->services['stages'] = app()->make('InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesDataTableServiceContract');
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
        $item = $this->services['stages']->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveStageRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveStageRequestContract $request): SaveResponseContract
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
        $item = $this->services['stages']->getItemById($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveStageRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveStageRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveStageRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveStageRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['stages']->save($request, $id);

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
        $result = $this->services['stages']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
