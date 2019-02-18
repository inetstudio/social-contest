<?php

namespace InetStudio\SocialContest\Points\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Points\Contracts\Events\Back\ModifyPointEventContract;

/**
 * Class ModifyPointEvent.
 */
class ModifyPointEvent implements ModifyPointEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyPointEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
