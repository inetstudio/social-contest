<?php

namespace InetStudio\SocialContest\Posts\Contracts\Services;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract
{
    /**
     * Возвращаем модель.
     *
     * @return PostModelContract
     */
    public function getModel(): PostModelContract;

    /**
     * Создаем модель.
     *
     * @return PostModelContract
     */
    public function create(): PostModelContract;

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
     * Получаем объекты по статусу.
     *
     * @param  StatusModelContract  $status
     *
     * @return Collection
     */
    public function getItemsByStatus(StatusModelContract $status): Collection;
}
