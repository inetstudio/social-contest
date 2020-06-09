<?php

namespace InetStudio\SocialContest\Posts\Http\Resources\Back\Resource\Update;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Update\ItemResourceContract;

class ItemResource extends JsonResource implements ItemResourceContract
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'prizes' => view(
                'admin.module.social-contest.posts::back.partials.datatables.prizes',
                [
                    'item' => $this
                ]
            )->render(),
            'updated_at' => (string) $this['updated_at'],
        ];
    }
}
