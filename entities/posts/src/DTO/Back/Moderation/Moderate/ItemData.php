<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO\Back\Moderation\Moderate;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Moderation\Moderate\ItemDataContract;

class ItemData extends FlexibleDataTransferObject implements ItemDataContract
{
    public int $id;

    public int $status_id;

    public array $additional_info;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'id' => $request->input('id'),
            'status_id' => $request->input('status_id'),
            'additional_info' => $request->input('additional_info', []),
        ]);
    }
}
