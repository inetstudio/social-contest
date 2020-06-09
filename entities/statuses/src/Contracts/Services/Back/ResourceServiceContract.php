<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Services\Back;

use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\DTO\Back\Resource\Save\ItemDataContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;

interface ResourceServiceContract extends BaseItemsServiceContract
{
    public function create(): StatusModelContract;

    public function show(int $id): StatusModelContract;

    public function save(ItemDataContract $data): StatusModelContract;

    public function destroy($id): int;
}
