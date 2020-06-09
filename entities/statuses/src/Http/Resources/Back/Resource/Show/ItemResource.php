<?php

namespace InetStudio\SocialContest\Statuses\Http\Resources\Back\Resource\Show;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract;

class ItemResource extends JsonResource implements ItemResourceContract
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'alias' => $this['alias'],
            'description' => $this['description'],
            'color_class' => $this['color_class'],
        ];
    }
}
