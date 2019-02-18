<?php

namespace InetStudio\SocialContest\Statuses\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\Classifiers\Models\ClassifierModel;
use InetStudio\SocialContest\Statuses\Models\StatusModel;

/**
 * Class StatusesSeedCommand.
 */
class StatusesSeedCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:social-contest:statuses:seed';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Seed social contest statuses';

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $statuses = [
            [
                'name' => 'Модерация',
                'alias' => 'moderation',
                'css_color' => 'warning',
                'description' => 'Посты, ожидающие модерацию',
                'types' => [
                    'default' => 'Статус по умолчанию',
                    'check' => 'Проверка',
                ],
            ],
            [
                'name' => 'Одобрено',
                'alias' => 'approved',
                'css_color' => 'primary',
                'description' => 'Одобренные посты',
                'types' => [
                    'main' => 'Основной статус',
                ],
            ],
            [
                'name' => 'Отклонено',
                'alias' => 'rejected',
                'css_color' => 'danger',
                'description' => 'Отклоненные посты',
            ],
            [
                'name' => 'Заблокировано',
                'alias' => 'blocked',
                'css_color' => 'danger',
                'description' => 'Заблокированные посты',
                'types' => [
                    'block' => 'Блокировать',
                ],
            ],
        ];

        foreach ($statuses as $status) {
            $statusObj = StatusModel::updateOrCreate([
                'name' => $status['name'],
                'alias' => $status['alias'],
                'description' => $status['description'],
            ]);

            $classifiers = [];
            if (isset($status['types'])) {
                foreach ($status['types'] as $alias => $value) {
                    $classifier = ClassifierModel::updateOrCreate([
                        'type' => 'Тип статуса социального поста',
                        'value' => $value,
                    ], [
                        'alias' => $alias,
                    ]);

                    $classifiers[] = $classifier;
                }
            }

            $statusObj->syncClassifiers($classifiers);
        }

        $this->info('Statuses seeding complete.');
    }
}
