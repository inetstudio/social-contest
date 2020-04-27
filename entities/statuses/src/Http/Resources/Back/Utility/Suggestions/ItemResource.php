<?php

namespace InetStudio\SocialContest\Statuses\Http\Resources\Back\Utility\Suggestions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemResourceContract;

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
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
        ];
    }
}
