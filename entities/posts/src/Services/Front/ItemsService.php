<?php

namespace InetStudio\SocialContest\Posts\Services\Front;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Posts\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

class ItemsService extends BaseItemsService implements ItemsServiceContract
{
    protected StatusesServiceContract $statusesService;

    public function __construct(StatusesServiceContract $statusesService, PostModelContract $model)
    {
        parent::__construct($model);

        $this->statusesService = $statusesService;
    }

    public function getItems(): Collection
    {
        $statuses = $this->statusesService->getItemsByType('final');

        return $this->getItemsByStatuses($statuses);
    }
}
