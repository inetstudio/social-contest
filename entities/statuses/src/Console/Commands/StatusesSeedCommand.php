<?php

namespace InetStudio\SocialContest\Statuses\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $groupsService = app()->make('InetStudio\Classifiers\Groups\Contracts\Services\Back\GroupsServiceContract');

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

        $now = Carbon::now()->format('Y-m-d H:m:s');

        $group = $groupsService->model::updateOrCreate([
            'name' => 'Тип статуса социального поста',
        ], [
            'alias' => 'social_post_status_types',
        ]);

        foreach ($statuses as $status) {
            $statusObj = StatusModel::updateOrCreate([
                'name' => $status['name'],
                'alias' => $status['alias'],
                'description' => $status['description'],
                'color_class' => $status['css_color'],
            ]);

            $classifiers = [];
            if (isset($status['types'])) {
                foreach ($status['types'] as $alias => $value) {
                    $id = DB::connection('mysql')->table('classifiers_entries')->insertGetId([
                        'value' => $value,
                        'alias' => $alias,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $group->entries()->attach($id);

                    $classifiers[] = $id;
                }
            }

            $statusObj->syncClassifiers($classifiers);
        }

        $this->info('Statuses seeding complete.');
    }
}
