<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Update\ItemDataContract;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract as PrizesServiceContract;

class ResourceService extends BaseItemsService implements ResourceServiceContract
{
    protected PrizesServiceContract $prizesService;

    public function __construct(
        PostModelContract $model,
        PrizesServiceContract $prizesService
    ) {
        parent::__construct($model);

        $this->prizesService = $prizesService;
    }

    public function show(int $id): PostModelContract
    {
        $item = $this->model::with('status', 'prizes', 'social', 'social.media', 'social.user')->find($id);

        return $item;
    }

    public function update(ItemDataContract $data): PostModelContract
    {
        $item = $this->model::find($data->id);

        $this->prizesService->attach($item, $data->prizes);

        $item = $item->fresh();

        event(
            resolve(
                'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        return $item;
    }

    public function destroy($id): int
    {
        return $this->model::destroy($id);
    }
}
