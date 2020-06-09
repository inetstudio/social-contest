<?php

namespace InetStudio\SocialContest\Prizes\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyItemEventContract;

class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    public PrizeModelContract $item;

    public function __construct(PrizeModelContract $item)
    {
        $this->item = $item;
    }
}
