<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Prizes\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\UtilityServiceContract;

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
