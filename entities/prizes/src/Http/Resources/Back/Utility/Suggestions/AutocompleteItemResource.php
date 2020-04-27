<?php

namespace InetStudio\SocialContest\Prizes\Http\Resources\Back\Utility\Suggestions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\AutocompleteItemResourceContract;

/**
 * Class AutocompleteItemResource.
 */
class AutocompleteItemResource extends JsonResource implements AutocompleteItemResourceContract
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
            'value' => $this['name'],
            'data' => [
                'id' => $this['id'],
                'type' => get_class($this),
                'title' => $this['name'],
            ],
        ];
    }
}
