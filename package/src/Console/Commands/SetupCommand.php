<?php

namespace InetStudio\SocialContest\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

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
                'description' => 'Social contest statuses setup',
                'command' => 'inetstudio:social-contest:statuses:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\SocialContest\Providers\ServiceProvider',
                    '--tag' => 'config',
                ],
            ],
        ];
    }
}
