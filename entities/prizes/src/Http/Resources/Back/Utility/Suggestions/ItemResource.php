<?php

namespace InetStudio\SocialContest\Prizes\Http\Resources\Back\Utility\Suggestions;

use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\ItemResourceContract;

class ItemResource extends JsonResource implements ItemResourceContract
{
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
