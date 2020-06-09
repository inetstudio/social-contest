<?php

namespace InetStudio\SocialContest\Posts\Listeners;

use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\BadResponseException;
use InetStudio\SocialContest\Posts\Contracts\Listeners\ItemStatusChangeListenerContract;

class ItemStatusChangeListener implements ItemStatusChangeListenerContract
{
    public function handle($event): void
    {
        $item = $event->item;
        $statusAlias = $item->status->alias;

        $email = $item->user->email;
        $name = $item->user->name;

        $subject = config('social_contest_posts.mails.status.'.$statusAlias.'.subject', '');

        try {
            Mail::send(
                'admin.module.social-contest.posts::mails.status.'.$statusAlias, compact('name'),
                function ($m) use ($email, $name, $subject) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));

                    $m->to($email, $name)->subject($subject);
                }
            );
        } catch (BadResponseException $e) {
        }
    }
}
