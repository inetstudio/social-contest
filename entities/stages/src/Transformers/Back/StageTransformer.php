<?php

namespace InetStudio\SocialContest\Stages\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\SocialContest\Stages\Contracts\Models\StageModelContract;
use InetStudio\SocialContest\Stages\Contracts\Transformers\Back\StageTransformerContract;

/**
 * Class StageTransformer.
 */
class StageTransformer extends TransformerAbstract implements StageTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param StageModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(StageModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'name' => $item->name,
            'alias' => $item->alias,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.social-contest.stages::back.partials.datatables.actions', compact('item'))
                ->render(),
        ];
    }
}
