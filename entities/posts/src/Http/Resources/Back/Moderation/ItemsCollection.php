<?php

namespace InetStudio\SocialContest\Posts\Http\Resources\Back\Moderation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract;

/**
 * Class ItemsCollection.
 */
class ItemsCollection extends ResourceCollection implements ItemsCollectionContract
{
    /**
     * ItemsCollection constructor.
     *
     * ItemsCollection constructor.
     *
     * @param $resource
     *
     * @throws BindingResolutionException
     */
    public function __construct($resource)
    {
        $itemResource = app()->make(
            'InetStudio\SocialContest\Posts\Contracts\Http\Resources\Back\Moderation\ItemResourceContract',
            [
                'resource' => null,
            ]
        );

        $this->collects = get_class($itemResource);

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'success' => (count($this->collection) > 0)
        ];
    }
}
