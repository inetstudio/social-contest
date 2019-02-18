<?php

namespace InetStudio\SocialContest\Statuses\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\SocialContest\Statuses\Contracts\Transformers\Back\StatusTransformerContract;

/**
 * Class StatusTransformer.
 */
class StatusTransformer extends TransformerAbstract implements StatusTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param StatusModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(StatusModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'name' => view('admin.module.social-contest.statuses::back.partials.datatables.name', compact('item'))
                ->render(),
            'alias' => $item->alias,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.social-contest.statuses::back.partials.datatables.actions', compact('item'))
                ->render(),
        ];
    }
}
