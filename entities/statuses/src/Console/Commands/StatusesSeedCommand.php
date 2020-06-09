<?php

namespace InetStudio\SocialContest\Statuses\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use InetStudio\SocialContest\Statuses\DTO\Back\Resource\Save\ItemData;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ResourceServiceContract as ResourceServiceContract;
use InetStudio\Classifiers\Groups\Contracts\Services\Back\ItemsServiceContract as ClassifiersGroupsServiceContract;
use InetStudio\Classifiers\Entries\Contracts\Services\Back\ItemsServiceContract as ClassifiersEntriesServiceContract;

class StatusesSeedCommand extends Command
{
    protected $name = 'inetstudio:social-contest:statuses:seed';

    protected $description = 'Seed social contest statuses';

    protected array $statuses = [
        [
            'name' => 'Модерация',
            'alias' => 'moderation',
            'description' => 'Посты, ожидающие модерацию',
            'color_class' => 'warning',
            'types' => [
                'social_contest_status_default' => 'Статус по умолчанию',
                'social_contest_status_check' => 'Проверка',
            ],
        ],
        [
            'name' => 'Предварительно одобрено',
            'alias' => 'preliminarily_approved',
            'description' => 'Предварительно одобренные посты',
            'color_class' => 'default',
            'types' => [
                'social_contest_status_draw' => 'Участвует в розыгрыше призов',
            ],
        ],
        [
            'name' => 'Одобрено',
            'alias' => 'approved',
            'description' => 'Одобренные посты',
            'color_class' => 'primary',
            'types' => [
                'social_contest_status_final' => 'Финальный статус',
                'social_contest_status_draw' => 'Участвует в розыгрыше призов',
            ],
        ],
        [
            'name' => 'Отклонено',
            'alias' => 'rejected',
            'description' => 'Отклоненные посты',
            'color_class' => 'danger',
            'types' => [
                'social_contest_status_reason' => 'Необходимо указать причину',
            ],
        ],
        [
            'name' => 'Заблокировано',
            'alias' => 'blocked',
            'description' => 'Заблокированные посты',
            'color_class' => 'danger',
            'types' => [
                'social_contest_status_reason' => 'Необходимо указать причину',
                'social_contest_status_mass' => 'Массовый перевод',
            ],
        ],
    ];

    protected ClassifiersGroupsServiceContract $groupsService;

    protected ClassifiersEntriesServiceContract $entriesService;

    protected ResourceServiceContract $statusesService;

    public function __construct(
        ClassifiersGroupsServiceContract $groupsService,
        ClassifiersEntriesServiceContract $entriesService,
        ResourceServiceContract $statusesService
    ) {
        parent::__construct();

        $this->groupsService = $groupsService;
        $this->entriesService = $entriesService;
        $this->statusesService = $statusesService;
    }

    public function handle(): void
    {
        $group = $this->groupsService->getModel()::updateOrCreate(
            [
                'name' => 'Тип статуса конкурсного поста',
            ],
            [
                'alias' => 'social_contest_status_type',
            ]
        );

        $entriesIDs = [];

        foreach ($this->statuses as $status) {
            $data = new ItemData(
                Arr::except($status, ['types'])
            );
            $statusObj = $this->statusesService->save($data);

            $classifiers = [];
            foreach ($status['types'] ?? [] as $alias => $value) {
                $entry = $this->entriesService->getModel()::updateOrCreate(
                    [
                        'alias' => $alias,
                    ],
                    [
                        'value' => $value,
                    ]
                );

                $classifiers[] = $entry['id'];
                $entriesIDs[] = $entry['id'];
            }

            $statusObj->syncClassifiers($classifiers);
        }

        $currentEntriesIDs = $group->entries()
            ->pluck('classifiers_entries.id')
            ->toArray();

        $entriesIDs = array_unique(array_merge($entriesIDs, $currentEntriesIDs));
        $group->entries()->sync($entriesIDs);

        $this->info('Statuses seeding complete.');
    }
}
