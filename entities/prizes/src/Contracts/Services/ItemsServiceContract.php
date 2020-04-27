<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Services;

use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract
{
    /**
     * Возвращаем модель.
     *
     * @return PrizeModelContract
     */
    public function getModel(): PrizeModelContract;

    /**
     * Создаем модель.
     *
     * @return PrizeModelContract
     */
    public function create(): PrizeModelContract;

    /**
     * Получаем объект по id.
     *
     * @param  mixed  $id
     * @param  bool  $returnNew
     *
     * @return mixed
     */
    public function getItemById($id = 0, bool $returnNew = true);
}
