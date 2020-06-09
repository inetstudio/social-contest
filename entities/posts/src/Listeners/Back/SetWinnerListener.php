<?php

namespace InetStudio\SocialContest\Posts\Listeners\Back;

use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\BadResponseException;
use InetStudio\SocialContest\Posts\Contracts\Listeners\Back\SetWinnerListenerContract;

class SetWinnerListener implements SetWinnerListenerContract
{
    public function handle($event): void
    {
        $item = $event->item;
        $prize = $event->prize;

        $email = $item->user->email;
        $name = $item->user->name;

        $subject = config('social_contest_posts.mails.win.'.$prize['alias'].'.subject', '');

        try {
            Mail::send(
                'admin.module.social-contest.posts::mails.win.'.$prize['alias'], compact('name', 'prize'),
                function ($m) use ($email, $name, $subject) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));

                    $m->to($email, $name)->subject($subject);
                }
            );
        } catch (BadResponseException $e) {
        }
    }
}
