<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use InetStudio\SocialContest\Prizes\Contracts\DTO\Back\Items\Attach\ItemDataContract;

class ItemData extends FlexibleDataTransferObject implements ItemDataContract
{
    public int $id;

    public PivotData $pivot;
}
