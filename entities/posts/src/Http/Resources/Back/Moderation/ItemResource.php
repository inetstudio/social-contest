<?php

namespace InetStudio\SocialContest\Posts\Http\Resources\Back\Moderation;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemResourceContract;

/**
 * Class ItemResource.
 */
class ItemResource extends JsonResource implements ItemResourceContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     *
     * @throws Throwable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'status' => view(
                'admin.module.social-contest.posts::back.partials.datatables.status',
                [
                    'item' => $this['status'],
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
