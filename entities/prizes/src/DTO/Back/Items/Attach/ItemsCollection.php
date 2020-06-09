<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach;

use Spatie\DataTransferObject\DataTransferObjectCollection;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Items\Attach\ItemDataContract;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Items\Attach\ItemsCollectionContract;

class ItemsCollection extends DataTransferObjectCollection implements ItemsCollectionContract
{
    public function current(): ItemDataContract
    {
        return parent::current();
    }
}
