<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Posts\Contracts\DTO\ItemDataContract;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseItemsService implements ItemsServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  ItemDataContract  $data
     *
     * @return PostModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(ItemDataContract $data): PostModelContract
    {
        $item = $this->model::updateOrCreate(
            [
                'id' => $data->id,
            ],
            $data->except('id')->toArray()
        );

        event(
            app()->make(
                'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param  mixed  $id
     *
     * @return int
     */
    public function destroy($id): int
    {
        return $this->model::destroy($id);
    }
}
