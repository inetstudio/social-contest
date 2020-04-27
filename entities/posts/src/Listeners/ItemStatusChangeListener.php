<?php

namespace InetStudio\SocialContest\Posts\Listeners;

use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\BadResponseException;
use InetStudio\SocialContest\Posts\Contracts\Listeners\ItemStatusChangeListenerContract;

/**
 * Class ItemStatusChangeListener.
 */
class ItemStatusChangeListener implements ItemStatusChangeListenerContract
{
    /**
     * Заголовки писем.
     *
     * @var array
     */
    protected array $subjects = [
        'moderation' => 'Ваш пост отправлен на проверку',
        'approved' => 'Ваш пост одобрен',
        'rejected' => 'Ваш пост отклонен',
    ];

    /**
     * Handle the event.
     *
     * @param  object  $event
     */
    public function handle($event): void
    {
        $item = $event->item;
        $statusAlias = $item->status->alias;

        $email = $item->getJSONData('additional_info', 'email');
        $name = $item->getJSONData('additional_info', 'name').' '.$item->getJSONData('additional_info', 'surname');

        $subject = $this->subjects[$statusAlias] ?? '';

        try {
            Mail::send(
                'admin.module.social-contest.posts::mails.'.$statusAlias, compact('name'),
                function ($m) use ($email, $name, $subject) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));

                    $m->to($email, $name)->subject($subject);
                }
            );
        } catch (BadResponseException $e) {
        }
    }
}
