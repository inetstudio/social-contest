<?php

namespace InetStudio\SocialContest\Posts\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Events\Back\SetWinnerEventContract;

class SetWinnerEvent implements SetWinnerEventContract
{
    use SerializesModels;

    public PostModelContract $item;

    public function __construct(PostModelContract $item)
    {
        $this->item = $item;
    }
}
