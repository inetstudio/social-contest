<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\Services;

use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Services\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService implements ItemsServiceContract
{
    /**
     * @var PrizeModelContract
     */
    protected PrizeModelContract $model;

    /**
     * ItemsService constructor.
     *
     * @param  PrizeModelContract  $model
     */
    public function __construct(PrizeModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Возвращаем модель.
     *
     * @return PrizeModelContract
     */
    public function getModel(): PrizeModelContract
    {
        return $this->model;
    }

    /**
     * Создаем модель.
     *
     * @return PrizeModelContract
     */
    public function create(): PrizeModelContract
    {
        return new $this->model;
    }

    /**
     * Получаем объект по id.
     *
     * @param  mixed  $id
     * @param  bool  $returnNew
     *
     * @return mixed
     */
    public function getItemById($id = 0, bool $returnNew = true)
    {
        return $this->model::find($id) ?? (($returnNew) ? $this->create() : null);
    }
}
