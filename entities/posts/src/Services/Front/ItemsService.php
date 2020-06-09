<?php

namespace InetStudio\SocialContest\Posts\Services\Front;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Services\ItemsService as BaseItemsService;
use InetStudio\SocialContest\Posts\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\ItemsServiceContract as StatusesServiceContract;

class ItemsService extends BaseItemsService implements ItemsServiceContract
{
    public array $stages = [];

    protected StatusesServiceContract $statusesService;

    public function __construct(StatusesServiceContract $statusesService, PostModelContract $model)
    {
        parent::__construct($model);

        $this->statusesService = $statusesService;
    }

    public function getItems(): Collection
    {
        $statuses = $this->statusesService->getItemsByType('final');

        return $this->getItemsByStatuses($statuses);
    }

    public function getContestStages(): array
    {
        $stages = [
            'prizes' => [],
            'totalWinners' => 0,
        ];

        foreach ($this->stages as $stage => $dates) {
            foreach ($dates as $date) {
                $key = $date['start'];
                $key .= ($date['end'] != $date['start']) ? $date['end'] : '';
                $key = md5($key);

                $stages['prizes'][$date['prize']]['stages'][$key] = [
                    'date' => [
                        'start' => $this->formatDate($date['start']),
                        'end' => $this->formatDate($date['end']),
                    ],
                    'winners' => [],
                ];

                $stages['prizes'][$date['prize']]['totalWinners'] = 0;
            }
        }

        $winnersPosts = $this->getModel()->whereHas('prizes', function ($prizesQuery) {
            $prizesQuery->where('social_contest_posts_prizes.confirmed', 1);
        })->get();

        foreach ($winnersPosts as $post) {
            foreach ($post->prizes as $prize) {
                if (isset($stages['prizes'][$prize['alias']]) && $prize->pivot->confirmed === 1) {
                    $key = '';
                    $key .= ($prize->pivot['date_start']) ? Carbon::createFromFormat('Y-m-d H:i:s', $prize->pivot['date_start'])->format('d.m.y') : '';
                    $key .= ($prize->pivot['date_end']) ? Carbon::createFromFormat('Y-m-d H:i:s', $prize->pivot['date_end'])->format('d.m.y') : '';
                    $key = md5($key);

                    $stages['prizes'][$prize['alias']]['stages'][$key]['winners'][] = [
                        'id' => $post['id'],
                        'name' => $post['social']['user']['nickname'],
                    ];

                    $stages['prizes'][$prize['alias']]['totalWinners'] += 1;
                    $stages['totalWinners'] += 1;
                }
            }
        }

        return $stages;
    }
}
