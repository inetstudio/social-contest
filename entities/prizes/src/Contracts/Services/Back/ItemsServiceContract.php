<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Services\ItemsServiceContract as BaseItemsServiceContract;

interface ItemsServiceContract extends BaseItemsServiceContract
{
    public function attach(PostModelContract $item, array $prizes): void;
}
