<?php

namespace InetStudio\SocialContest\Prizes\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\SocialContest\Prizes\Contracts\Events\Back\ModifyPrizeEventContract;

/**
 * Class ModifyPrizeEvent.
 */
class ModifyPrizeEvent implements ModifyPrizeEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyPrizeEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
