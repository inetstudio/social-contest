<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
use InetStudio\SocialContest\Posts\Contracts\DTO\ItemDataContract;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;

class ItemData extends FlexibleDataTransferObject implements ItemDataContract
{
    public int $id = 0;

    public int $user_id = 0;

    public string $uuid = '';

    public string $social_type = '';

    public int $social_id = 0;

    public int $status_id = 1;

    public array $search_data = [];

    public array $additional_info = [];

    public static function fromRequest(Request $request): self
    {
        return new self([
            'id' => (int) $request->input('id', 0),
            'uuid' => trim(strip_tags($request->input('uuid', ''))),
            'social_type' => trim(strip_tags($request->input('social_type', ''))),
            'social_id' => (int) $request->input('social_id', 0),
            'status_id' => (int) $request->input('status_id'),
            'search_data' => Arr::wrap($request->input('search_data', [])),
            'additional_info' => Arr::wrap($request->input('additional_info', [])),
        ]);
    }

    public static function fromItem(PostModelContract $item): self
    {
        return new self($item->toArray());
    }
}
