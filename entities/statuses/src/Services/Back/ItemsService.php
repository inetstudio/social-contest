<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Statuses\Services\Back;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\DTO\ItemDataContract;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract;

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
     * @return StatusModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(ItemDataContract $data): StatusModelContract
    {
        $item = $this->model::updateOrCreate(
            [
                'id' => $data->id,
            ],
            $data->except('id', 'classifiers')->toArray()
        );

        $classifiersData = $data->classifiers;
        app()->make('InetStudio\Classifiers\Entries\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($classifiersData, $item);

        event(
            app()->make(
                'InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyItemEventContract',
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
