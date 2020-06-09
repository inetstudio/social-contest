<?php

namespace InetStudio\SocialContest\Posts\Http\Resources\Back\Resource\Show;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract;

class ItemResource extends JsonResource implements ItemResourceContract
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'uuid' => $this['uuid'],
            'social' => $this['social'],
            'status' => resolve('InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract', ['resource' => $this['status']]),
            'prizes' => resolve('InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Show\ItemsCollectionContract', ['resource' => $this['prizes']]),
        ];
    }
}
