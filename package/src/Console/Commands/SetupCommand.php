<?php

namespace InetStudio\SocialContest\Console\Commands;

use InetStudio\AdminPanel\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:social-contest:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup social contest package';

    /**
     * Инициализация команд.
     *
     * @return void
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => '',
                'command' => 'inetstudio:instagram:setup',
            ],
            [
                'type' => 'artisan',
                'description' => '',
                'command' => 'inetstudio:vkontakte:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Social contest points setup',
                'command' => 'inetstudio:social-contest:points:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Social contest posts setup',
                'command' => 'inetstudio:social-contest:posts:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Social contest prizes setup',
                'command' => 'inetstudio:social-contest:prizes:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Social contest stages setup',
                'command' => 'inetstudio:social-contest:stages:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Social contest statuses setup',
                'command' => 'inetstudio:social-contest:statuses:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Social contest tags setup',
                'command' => 'inetstudio:social-contest:tags:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\SocialContest\Providers\SocialContestServiceProvider',
                    '--tag' => 'config',
                ],
            ],
        ];
    }
}
