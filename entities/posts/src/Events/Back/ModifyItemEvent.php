<?php

namespace InetStudio\SocialContest\Posts\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var PostModelContract
     */
    public PostModelContract $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  PostModelContract  $item
     */
    public function __construct(PostModelContract $item)
    {
        $this->item = $item;
    }
}