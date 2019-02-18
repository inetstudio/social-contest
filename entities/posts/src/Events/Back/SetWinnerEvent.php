<?php

namespace InetStudio\SocialContest\Posts\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Posts\Contracts\Events\Back\SetWinnerEventContract;

/**
 * Class SetWinnerEvent.
 */
class SetWinnerEvent implements SetWinnerEventContract
{
    use SerializesModels;

    public $object;

    /**
     * SetWinnerEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
