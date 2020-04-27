<?php

namespace InetStudio\SocialContest\Posts\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Events\Back\ModerateItemEventContract;

/**
 * Class ModerateItemEvent.
 */
class ModerateItemEvent implements ModerateItemEventContract
{
    use SerializesModels;

    /**
     * @var PostModelContract
     */
    public PostModelContract $item;

    /**
     * ModerateItemEvent constructor.
     *
     * @param  PostModelContract  $item
     */
    public function __construct(PostModelContract $item)
    {
        $this->item = $item;
    }
}
