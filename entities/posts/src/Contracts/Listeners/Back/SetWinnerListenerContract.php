<?php

namespace InetStudio\SocialContest\Posts\Contracts\Listeners\Back;

/**
 * Interface SetWinnerListenerContract.
 */
interface SetWinnerListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event): void;
}
