<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\Services\Back;

use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Resource\Save\ItemDataContract;

class ResourceService extends BaseItemsService implements ResourceServiceContract
{
    public function create(): PrizeModelContract
    {
        return new $this->model;
    }

    public function show(int $id): PrizeModelContract
    {
        $item = $this->model::find($id);

        return $item;
    }

    public function save(ItemDataContract $data): PrizeModelContract
    {
        $item = $this->model::find($data->id) ?? new $this->model;

        $item->name = $data->name;
        $item->alias = $data->alias;

        $item->save();

        event(
            resolve(
                'InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        return $item;
    }

    public function destroy($id): int
    {
        return $this->model::destroy($id);
    }
}
