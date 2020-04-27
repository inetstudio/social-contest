<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO;

use Spatie\DataTransferObject\DataTransferObjectCollection;
use InetStudio\SocialContest\Posts\Contracts\DTO\ItemsCollectionContract;

class ItemsCollection extends DataTransferObjectCollection implements ItemsCollectionContract
{
    public function current(): ItemData
    {
        return parent::current();
    }
}
