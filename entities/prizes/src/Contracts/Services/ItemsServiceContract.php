<?php

namespace InetStudio\SocialContest\Prizes\Contracts\Services;

use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;

interface ItemsServiceContract
{
    public function getModel(): PrizeModelContract;
}
