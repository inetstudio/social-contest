<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Resource;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Resource\ModerateResponseContract;

/**
 * Class ModerateResponse.
 */
class ModerateResponse implements ModerateResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * @var Collection
     */
    protected $items;

    /**
     * DestroyResponse constructor.
     *
     * @param bool $result
     * @param Collection $items
     */
    public function __construct(bool $result, Collection $items)
    {
        $this->result = $result;
        $this->items = $items;
    }

    /**
     * Возвращаем ответ при модерации объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function toResponse($request): JsonResponse
    {
        $responseData = ($this->result) ? [
            'success' => true,
            'ids' => $this->items->pluck('id'),
            'status' => view('admin.module.social-contest.posts::back.partials.datatables.status', [
                'item' => $this->items->first()->status,
            ])->render(),
            'moderation' => $this->items->mapWithKeys(function ($item) {
                return [
                    $item->id => view('admin.module.social-contest.posts::back.partials.datatables.moderation', [
                        'item' => $item,
                    ])->render(),
                ];
            }),
        ] : [
            'success' => false,
        ];

        return response()->json($responseData);
    }
}
