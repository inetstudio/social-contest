<?php

namespace InetStudio\SocialContest\Stages\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Stages\Contracts\Events\Back\ModifyStageEventContract;

/**
 * Class ModifyStageEvent.
 */
class ModifyStageEvent implements ModifyStageEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyStageEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
