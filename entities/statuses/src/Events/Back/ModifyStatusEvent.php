<?php

namespace InetStudio\SocialContest\Statuses\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Statuses\Contracts\Events\Back\ModifyStatusEventContract;

/**
 * Class ModifyStatusEvent.
 */
class ModifyStatusEvent implements ModifyStatusEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyStatusEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
