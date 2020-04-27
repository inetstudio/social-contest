<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Services\Back;

use InetStudio\SocialContest\Statuses\Contracts\DTO\ItemDataContract;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseItemsServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  ItemDataContract  $data
     *
     * @return StatusModelContract
     */
    public function save(ItemDataContract $data): StatusModelContract;

    /**
     * Удаляем модель.
     *
     * @param  mixed  $id
     *
     * @return int
     */
    public function destroy($id): int;
}
