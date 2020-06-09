<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Services\Back;

use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Resource\Save\ItemDataContract;
use InetStudio\SocialContest\Prizes\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;

interface ResourceServiceContract extends BaseItemsServiceContract
{
    public function create(): PrizeModelContract;

    public function show(int $id): PrizeModelContract;

    public function save(ItemDataContract $data): PrizeModelContract;

    public function destroy($id): int;
}
