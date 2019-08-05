<?php

namespace InetStudio\SocialContest\Prizes\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\SavePrizeRequestContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\PrizesControllerContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Prizes\FormResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Prizes\SaveResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Prizes\IndexResponseContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Prizes\DestroyResponseContract;

/**
 * Class PrizesController.
 */
class PrizesController extends Controller implements PrizesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * PrizesController constructor.
     */
    public function __construct()
    {
        $this->services['prizes'] = app()->make('InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesDataTableServiceContract');
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
        $item = $this->services['prizes']->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SavePrizeRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SavePrizeRequestContract $request): SaveResponseContract
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
        $item = $this->services['prizes']->getItemById($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SavePrizeRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SavePrizeRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SavePrizeRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SavePrizeRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['prizes']->save($request, $id);

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
        $result = $this->services['prizes']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
