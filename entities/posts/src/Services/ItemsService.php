<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\Services;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

class ItemsService implements ItemsServiceContract
{
    protected PostModelContract $model;

    public function __construct(PostModelContract $model)
    {
        $this->model = $model;
    }

    public function getModel(): PostModelContract
    {
        return $this->model;
    }

    public function create(): PostModelContract
    {
        return new $this->model;
    }

    public function getItemById($id = 0, bool $returnNew = true)
    {
        return $this->model::find($id) ?? (($returnNew) ? $this->create() : null);
    }

    public function getItemsByStatuses(Collection $statuses): Collection
    {
        $statusesIds = $statuses->pluck('id')->toArray();

        return $this->model::with('social', 'social.media', 'social.user')->whereIn('status_id', $statusesIds)->get();
    }
}
