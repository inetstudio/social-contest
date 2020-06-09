<?php

namespace InetStudio\SocialContest\Posts\Http\Resources\Back\Moderation;

use Illuminate\Http\Resources\Json\ResourceCollection;
use InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract;

class ItemsCollection extends ResourceCollection implements ItemsCollectionContract
{
    public function __construct($resource)
    {
        $itemResource = resolve(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemResourceContract',
            [
                'resource' => null,
            ]
        );

        $this->collects = get_class($itemResource);

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'success' => (count($this->collection) > 0)
        ];
    }
}
