<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use InetStudio\SocialContest\Prizes\DTO\ItemData;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Prizes\Contracts\DTO\ItemDataContract;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract;

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
     * @return PrizeModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(ItemDataContract $data): PrizeModelContract
    {
        $item = $this->model::updateOrCreate(
            [
                'id' => $data->id,
            ],
            $data->except('id')->toArray()
        );

        event(
            app()->make(
                'InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyItemEventContract',
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

    /**
     * Присваиваем призы объекту.
     *
     * @param  ItemData[]|null  $prizes
     * @param $item
     *
     * @throws BindingResolutionException
     */
    public function attachToObject($prizes, $item): void
    {
        if ($prizes === null) {
            return;
        }

        $oldPrizes = $item->prizes;

        if (! empty($prizes)) {
            $prizes = collect($prizes)->mapWithKeys(function ($item) {
                return [
                    $item->id => $item->pivot->except('created_at', 'updated_at')->toArray(),
                ];
            })->toArray();

            $item->prizes()->sync($prizes);
        } else {
            $item->prizes()->detach();
        }

        $newPrizes = $item->fresh()->prizes;

        $this->fireWinnerEvent($item, $oldPrizes, $newPrizes);
    }

    /**
     * Событие при подтверждении приза.
     *
     * @param  PostModelContract  $post
     * @param  Collection  $oldPrizes
     * @param  Collection  $newPrizes
     *
     * @throws BindingResolutionException
     */
    protected function fireWinnerEvent(PostModelContract $post, Collection $oldPrizes, Collection $newPrizes): void
    {
        $oldConfirmed = $oldPrizes->mapWithKeys(function ($item) {
            return [
                $item->id => $item->pivot->confirmed,
            ];
        });

        foreach ($newPrizes as $prize) {
            if ($prize->pivot->confirmed == 1 && (isset($oldConfirmed[$prize->id]) && $oldConfirmed[$prize->id] == 0 || ! isset($oldConfirmed[$prize->id]))) {
                event(
                    app()->make(
                        'InetStudio\SocialContest\Posts\Contracts\Events\Back\SetWinnerEventContract',
                        compact('post', 'prize')
                    )
                );
            }
        }
    }
}
