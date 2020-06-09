<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ResourceServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Services\Back\ItemsServiceContract as PrizesServiceContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Update\ItemDataContract as UpdateDataContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Store\ItemDataContract as StoreDataContract;

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

    public function store(StoreDataContract $data): PostModelContract
    {
        $item = $this->model::where(['social_id' => $data->social_id])->where(['social_type' => $data->social_type])->first();

        if ($item) {
            return $item;
        }

        $item = new $this->model;

        $item->uuid = (string) $data->uuid;
        $item->user_id = $data->user_id;
        $item->social_id = $data->social_id;
        $item->social_type = $data->social_type;
        $item->status_id = $data->status_id;
        $item->search_data = $data->search_data;
        $item->additional_info = $data->additional_info;

        $item->save();

        $item = $item->fresh();

        event(
            resolve(
                'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        return $item;
    }

    public function update(UpdateDataContract $data): PostModelContract
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
