<?php

namespace InetStudio\SocialContest\Prizes\Http\Resources\Back\Resource\Show;

use Illuminate\Http\Resources\Json\ResourceCollection;
use InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Show\ItemsCollectionContract;

class ItemsCollection extends ResourceCollection implements ItemsCollectionContract
{
    public function __construct($resource)
    {
        $itemResource = resolve(
            'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Resource\Show\ItemResourceContract',
            [
                'resource' => null,
            ]
        );

        $this->collects = get_class($itemResource);

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return $this->collection;
    }
}
