<?php

namespace InetStudio\SocialContest\Posts\Contracts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Update\ItemDataContract;
use InetStudio\SocialContest\Posts\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;

interface ResourceServiceContract extends BaseItemsServiceContract
{
    public function show(int $id): PostModelContract;

    public function update(ItemDataContract $data): PostModelContract;

    public function destroy($id): int;
}
