<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

interface ItemsServiceContract
{
    public function getModel(): StatusModelContract;

    public function getItemsByType(string $type): Collection;
}
