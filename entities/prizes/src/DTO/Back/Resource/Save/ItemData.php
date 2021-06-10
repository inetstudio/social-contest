<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\DTO\Back\Resource\Save;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Resource\Save\ItemDataContract;

class ItemData extends DataTransferObject implements ItemDataContract
{
    public int $id = 0;

    public string $name;

    public string $alias;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'id' => (int) $request->input('id'),
            'name' => trim(strip_tags($request->input('name'))),
            'alias' => trim(strip_tags($request->input('alias'))),
        ]);
    }
}
