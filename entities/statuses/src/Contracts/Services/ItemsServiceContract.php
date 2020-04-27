<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract
{
    /**
     * Возвращаем модель.
     *
     * @return StatusModelContract
     */
    public function getModel(): StatusModelContract;

    /**
     * Создаем модель.
     *
     * @return StatusModelContract
     */
    public function create(): StatusModelContract;

    /**
     * Получаем объект по id.
     *
     * @param  mixed  $id
     * @param  bool  $returnNew
     *
     * @return mixed
     */
    public function getItemById($id = 0, bool $returnNew = true);

    /**
     * Возвращаем статусы по типу.
     *
     * @param  string  $type
     *
     * @return Collection
     */
    public function getItemsByType(string $type): Collection;
}
