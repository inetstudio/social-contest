<?php

namespace InetStudio\SocialContest\Posts\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Transformers\Back\PostTransformerContract;

/**
 * Class PostTransformer.
 */
class PostTransformer extends TransformerAbstract implements PostTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param PostModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(PostModelContract $item): array
    {
        return [
            'DT_RowId' => 'post_row_'.$item->id,
            'search_data' => '',
            'status' => view('admin.module.social-contest.posts::back.partials.datatables.status', [
                'item' => $item['status'],
            ])->render(),
            'moderation' => view('admin.module.social-contest.posts::back.partials.datatables.moderation', compact('item'))
                ->render(),
            'media' => view('admin.module.social-contest.posts::back.partials.datatables.media', compact('item'))
                ->render(),
            'info' => view('admin.module.social-contest.posts::back.partials.datatables.info', compact('item'))->render(),
            'created_at' => (string) $item['created_at'],
            'updated_at' => (string) $item['updated_at'],
            'actions' => view('admin.module.social-contest.posts::back.partials.datatables.actions', compact('item'))
                ->render(),
        ];
    }
}
