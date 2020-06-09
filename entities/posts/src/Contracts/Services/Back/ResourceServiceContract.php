<?php

namespace InetStudio\SocialContest\Posts\Contracts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Store\ItemDataContract as StoreDataContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Update\ItemDataContract as UpdateDataContract;

interface ResourceServiceContract extends BaseItemsServiceContract
{
    public function show(int $id): PostModelContract;

    public function store(StoreDataContract $data): PostModelContract;

    public function update(UpdateDataContract $data): PostModelContract;

    public function destroy($id): int;
}
