<?php

namespace InetStudio\SocialContest\Prizes\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Transformers\Back\PrizeTransformerContract;

/**
 * Class PrizeTransformer.
 */
class PrizeTransformer extends TransformerAbstract implements PrizeTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param PrizeModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(PrizeModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'name' => $item->name,
            'alias' => $item->alias,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.social-contest.prizes::back.partials.datatables.actions', compact('item'))
                ->render(),
        ];
    }
}
