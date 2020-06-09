<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Prizes\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Items\Attach\ItemsCollectionContract;

class ItemsService extends BaseItemsService implements ItemsServiceContract
{
    public function attach(PostModelContract $item, ItemsCollectionContract $prizes): void
    {
        if (count($prizes) === 0) {
            $item->prizes()->detach();

            return;
        }

        $oldPrizes = $item['prizes'];

        $prizes = collect($prizes)->mapWithKeys(function ($prize) {
            return [
                $prize->id => $prize->pivot->toArray(),
            ];
        })->toArray();

        $item->prizes()->sync($prizes);

        $newPrizes = $item->fresh()->prizes;

        $this->fireWinnerEvent($item, $oldPrizes, $newPrizes);
    }

    protected function fireWinnerEvent(PostModelContract $post, Collection $oldPrizes, Collection $newPrizes): void
    {
        $oldConfirmed = $oldPrizes->mapWithKeys(function ($item) {
            return [
                $item->id => $item->pivot->confirmed,
            ];
        });

        foreach ($newPrizes as $prize) {
            if (! ($prize->pivot->confirmed === 1 && ($oldConfirmed[$prize->id] ?? 0) === 0)) {
                continue;
            }

            event(
                resolve(
                    'InetStudio\SocialContest\Posts\Contracts\Events\Back\SetWinnerEventContract',
                    [
                        'item' => $post,
                        'prize' => $prize,
                    ]
                )
            );
        }
    }
}
