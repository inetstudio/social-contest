<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Statuses\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
use InetStudio\SocialContest\Statuses\Contracts\DTO\ItemDataContract;

class ItemData extends FlexibleDataTransferObject implements ItemDataContract
{
    public int $id = 0;

    public string $name;

    public string $alias;

    public string $description = '';

    public string $color_class = 'default';

    public array $classifiers = [];

    public static function fromRequest(Request $request): self
    {
        $description = $request->input('description');
        $description = (isset($description['text'])) ? $description['text'] : (! is_array($description) ? $description : '');

        return new self([
            'id' => (int) $request->input('id'),
            'name' => trim(strip_tags($request->input('name'))),
            'alias' => trim(strip_tags($request->input('alias'))),
            'description' => trim(str_replace('&nbsp;', ' ', strip_tags($description))),
            'color_class' => trim(strip_tags($request->input('color_class'))),
            'classifiers' => $request->input('classifiers'),
        ]);
    }
}
