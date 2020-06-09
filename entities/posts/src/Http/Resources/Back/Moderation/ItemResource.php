<?php

namespace InetStudio\SocialContest\Posts\Http\Resources\Back\Moderation;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemResourceContract;

class ItemResource extends JsonResource implements ItemResourceContract
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'status' => view(
                'admin.module.social-contest.posts::back.partials.datatables.status',
                [
                    'item' => $this,
                ]
            )->render(),
            'moderation' => view(
                'admin.module.social-contest.posts::back.partials.datatables.moderation',
                [
                    'item' => $this,
                ]
            )->render(),
            'updated_at' => (string) $this['updated_at'],
        ];
    }
}
