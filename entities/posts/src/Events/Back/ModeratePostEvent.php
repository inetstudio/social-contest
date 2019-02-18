<?php

namespace InetStudio\SocialContest\Posts\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Posts\Contracts\Events\Back\ModeratePostEventContract;

/**
 * Class ModeratePostEvent.
 */
class ModeratePostEvent implements ModeratePostEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModeratePostEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
