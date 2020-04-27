<?php

namespace InetStudio\SocialContest\Prizes\Http\Resources\Back\Utility\Suggestions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\ItemsCollectionContract;

/**
 * Class ItemsCollection.
 */
class ItemsCollection extends ResourceCollection implements ItemsCollectionContract
{
    /**
     * @var string
     */
    protected string $type;

    /**
     * ItemsCollection constructor.
     *
     * ItemsCollection constructor.
     *
     * @param $resource
     * @param  string  $type
     *
     * @throws BindingResolutionException
     */
    public function __construct($resource, string $type = '')
    {
        $this->type = $type;

        if ($type == 'autocomplete') {
            $itemResource = app()->make(
                'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\AutocompleteItemResourceContract',
                [
                    'resource' => null,
                ]
            );
        } else {
            $itemResource = app()->make(
                'InetStudio\SocialContest\Prizes\Contracts\Http\Resources\Back\Utility\Suggestions\ItemResourceContract',
                [
                    'resource' => null,
                ]
            );
        }

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
            ($this->type == 'autocomplete') ? 'suggestions' : 'items' => $this->collection,
        ];
    }
}
