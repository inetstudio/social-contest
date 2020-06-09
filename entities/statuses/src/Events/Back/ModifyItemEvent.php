<?php

namespace InetStudio\SocialContest\Statuses\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyItemEventContract;

class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    public StatusModelContract $item;

    public function __construct(StatusModelContract $item)
    {
        $this->item = $item;
    }
}
