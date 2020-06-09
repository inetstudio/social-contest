<?php

namespace InetStudio\SocialContest\Prizes\Http\Resources\Back\Resource\Index;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Index\ItemResourceContract;

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
                    'admin.module.social-contest.prizes::back.partials.datatables.actions',
                    [
                        'item' => $this,
                    ]
                )
                ->render(),
        ];
    }
}
