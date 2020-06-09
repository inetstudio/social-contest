<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Statuses\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Statuses\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\UtilityServiceContract;

class UtilityService extends BaseItemsService implements UtilityServiceContract
{
    public function getSuggestions(string $search): Collection
    {
        return $this->model::where(
            [
                ['name', 'LIKE', '%'.$search.'%'],
            ]
        )->get();
    }
}
