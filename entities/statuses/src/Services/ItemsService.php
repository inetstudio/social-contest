<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Statuses\Services;

use Illuminate\Database\Eloquent\Collection;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\ItemsServiceContract;

class ItemsService implements ItemsServiceContract
{
    protected StatusModelContract $model;

    public function __construct(StatusModelContract $model)
    {
        $this->model = $model;
    }

    public function getModel(): StatusModelContract
    {
        return $this->model;
    }

    public function getItemsByType(string $type): Collection
    {
        return $this->model::whereHas(
            'classifiers',
            function ($classifiersQuery) use ($type) {
                $classifiersQuery->select(['classifiers_entries.id', 'classifiers_entries.alias'])
                    ->where('classifiers_entries.alias', 'social_contest_status_'.$type);
            }
        )->get();
    }
}
