<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\DTO\ItemData;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

class ModerateService extends ItemsService implements ModerateServiceContract
{
    protected StatusesServiceContract $statusesService;

    public function __construct(StatusesServiceContract $statusesService, PostModelContract $model)
    {
        parent::__construct($model);

        $this->statusesService = $statusesService;
    }

    /**
     * Модерация объекта.
     *
     * @param  int  $id
     * @param  string  $alias
     * @param  array  $additionalData
     *
     * @return Collection
     */
    public function moderate(int $id, string $alias, array $additionalData = []): Collection
    {
        $items = collect([]);

        $item = $this->getItemById($id);

        $status = $this->statusesService->getModel()->where('alias', '=', $alias)->first();
        $massStatuses = $this->statusesService->getItemsByType('mass');

        if (! $item->id || ! $status) {
            return $items;
        }

        $items->push($item);

        if ($massStatuses->contains($status)) {
            $userSocialPosts = $item->social->user->posts;

            $userPosts = $this->getModel()
                ->whereIn('social_id', $userSocialPosts->pluck('id')->toArray())
                ->where('social_type', get_class($userSocialPosts->first()))
                ->get();

            $userPosts->each(function ($userPost) use ($items) {
                $items->push($userPost);
            });
        }

        $items = $items->unique('uuid')
            ->map(function ($item) use ($status, $additionalData) {
                $data = ItemData::fromItem($item);
                $data->status_id = $status['id'];
                $data->additional_info = array_merge($item->additional_info, $additionalData);

                $savedItem = $this->save($data)->fresh();

                event(
                    app()->make(
                        'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModerateItemEventContract',
                        [
                            'item' => $savedItem,
                        ]
                    )
                );

                return $savedItem;
            });

        return $items;
    }
}
