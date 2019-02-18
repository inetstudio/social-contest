<?php

namespace InetStudio\SocialContest\Posts\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Posts\Contracts\Events\Back\ModifyPostEventContract;

/**
 * Class ModifyPostEvent.
 */
class ModifyPostEvent implements ModifyPostEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyPostEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
