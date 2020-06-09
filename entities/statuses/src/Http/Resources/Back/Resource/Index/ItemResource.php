<?php

namespace InetStudio\SocialContest\Statuses\Http\Resources\Back\Resource\Index;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract;

class ItemResource extends JsonResource implements ItemResourceContract
{
    public function toArray($request)
    {
        return [
            'id' => (int) $this['id'],
            'name' => $this['name'],
            'alias' => $this['alias'],
            'created_at' => (string) $this['created_at'],
            'updated_at' => (string) $this['updated_at'],
            'actions' => view(
                    'admin.module.social-contest.statuses::back.partials.datatables.actions',
                    [
                        'item' => $this,
                    ]
                )
                ->render(),
        ];
    }
}
