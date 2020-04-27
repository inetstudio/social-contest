<?php

namespace InetStudio\SocialContest\Posts\Contracts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\DTO\ItemDataContract;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;

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
     * @return PostModelContract
     */
    public function save(ItemDataContract $data): PostModelContract;

    /**
     * Удаляем модель.
     *
     * @param  mixed  $id
     *
     * @return int
     */
    public function destroy($id): int;
}
