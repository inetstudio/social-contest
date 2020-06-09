<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO\Back\Resource\Store;

use Ramsey\Uuid\UuidInterface;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Store\ItemDataContract;

class ItemData extends FlexibleDataTransferObject implements ItemDataContract
{
    public UuidInterface $uuid;

    public string $social_type = '';

    public int $social_id = 0;

    public array $search_data = [];

    public array $additional_info = [];

    public int $status_id = 1;

    public int $user_id = 0;
}
