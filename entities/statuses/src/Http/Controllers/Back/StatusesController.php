<?php

namespace InetStudio\SocialContest\Statuses\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\DestroyResponseContract;

/**
 * Class StatusesController.
 */
class StatusesController extends Controller implements StatusesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * StatusesController constructor.
     */
    public function __construct()
    {
        $this->services['statuses'] = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract');
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
     * Добавление объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['statuses']->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveStatusRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveStatusRequestContract $request): SaveResponseContract
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
        $item = $this->services['statuses']->getItemById($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveStatusRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveStatusRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['statuses']->save($request, $id);

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
        $result = $this->services['statuses']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
