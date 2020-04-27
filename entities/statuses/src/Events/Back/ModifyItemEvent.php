<?php

namespace InetStudio\SocialContest\Statuses\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var StatusModelContract
     */
    public StatusModelContract $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  StatusModelContract  $item
     */
    public function __construct(StatusModelContract $item)
    {
        $this->item = $item;
    }
}
