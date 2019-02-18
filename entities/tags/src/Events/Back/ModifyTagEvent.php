<?php

namespace InetStudio\SocialContest\Tags\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Tags\Contracts\Events\Back\ModifyTagEventContract;

/**
 * Class ModifyTagEvent.
 */
class ModifyTagEvent implements ModifyTagEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyTagEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
