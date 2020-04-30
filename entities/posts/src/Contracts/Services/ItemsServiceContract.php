<?php

namespace InetStudio\SocialContest\Posts\Contracts\Services;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;

interface ItemsServiceContract
{
    public function getModel(): PostModelContract;

    public function create(): PostModelContract;

    public function getItemById($id = 0, bool $returnNew = true);

    public function getItemsByStatuses(Collection $statuses): Collection;
}
