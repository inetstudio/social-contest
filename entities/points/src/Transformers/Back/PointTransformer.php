<?php

namespace InetStudio\SocialContest\Points\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\SocialContest\Points\Contracts\Models\PointModelContract;
use InetStudio\SocialContest\Points\Contracts\Transformers\Back\PointTransformerContract;

/**
 * Class PointTransformer.
 */
class PointTransformer extends TransformerAbstract implements PointTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param PointModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(PointModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'name' => view('admin.module.social-contest.points::back.partials.datatables.name', compact('item'))
                ->render(),
            'alias' => $item->alias,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.social-contest.points::back.partials.datatables.actions', compact('item'))
                ->render(),
        ];
    }
}
