<?php

namespace InetStudio\SocialContest\Posts\Listeners\Back;

use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\BadResponseException;
use InetStudio\SocialContest\Posts\Contracts\Listeners\Back\SetWinnerListenerContract;

/**
 * Class SetWinnerListener.
 */
class SetWinnerListener implements SetWinnerListenerContract
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     */
    public function handle($event): void
    {
        $item = $event->check;
        $prize = $event->prize;

        $email = $item->getJSONData('additional_info', 'email');
        $name = $item->getJSONData('additional_info', 'name').' '.$item->getJSONData('additional_info', 'surname');

        $subject = 'Вы выиграли приз';

        try {
            Mail::send(
                'admin.module.social-contest.posts::mails.win', compact('name', 'prize'),
                function ($m) use ($email, $name, $subject) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));

                    $m->to($email, $name)->subject($subject);
                }
            );
        } catch (BadResponseException $e) {
        }
    }
}
