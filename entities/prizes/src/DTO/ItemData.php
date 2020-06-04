<?php

namespace InetStudio\SocialContest\Prizes\DTO;

use Illuminate\Support\Arr;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
use InetStudio\SocialContest\Prizes\Contracts\DTO\ItemDataContract;

class ItemData extends FlexibleDataTransferObject implements ItemDataContract
{
    public int $id = 0;

    public string $name;

    public string $alias;

    /**
     * @var \InetStudio\SocialContest\Prizes\DTO\PivotData|null
     */
    public $pivot = [];

    public static function prepareData(array $data): self
    {
        return new self([
            'id' => (int) Arr::get($data, 'id', 0),
            'name' => trim(strip_tags(Arr::get($data, 'name'))),
            'alias' => trim(strip_tags(Arr::get($data, 'alias'))),
            'pivot' => (! empty(Arr::get($data, 'pivot', [])))
                ? PivotData::prepareData(Arr::get($data, 'pivot'))
                : [],
        ]);
    }
}
