<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO\Back\Moderation\Moderate;

use Spatie\DataTransferObject\DataTransferObjectCollection;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Moderation\Moderate\ItemDataContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Moderation\Moderate\ItemsCollectionContract;

class ItemsCollection extends DataTransferObjectCollection implements ItemsCollectionContract
{
    public function current(): ItemDataContract
    {
        return parent::current();
    }
}
