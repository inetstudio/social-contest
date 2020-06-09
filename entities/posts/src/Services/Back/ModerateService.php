<?php

namespace InetStudio\SocialContest\Posts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Moderation\Moderate\ItemDataContract;

class ModerateService extends ItemsService implements ModerateServiceContract
{
    public function moderate(ItemDataContract $data): PostModelContract
    {
        $item = $this->model::find($data->id);

        $item->status_id = $data->status_id;
        $item->setJSONData('additional_info', 'statusReason', $data->additional_info['statusReason'] ?? '');

        $item->save();

        event(
            resolve(
                'InetStudio\SocialContest\Posts\Contracts\Events\Back\ModerateItemEventContract',
                compact('item')
            )
        );

        return $item;
    }
}
