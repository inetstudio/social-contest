<?php

namespace InetStudio\SocialContest\Points\Http\Responses\Back\Points;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Points\Contracts\Models\PointModelContract;
use InetStudio\SocialContest\Points\Contracts\Http\Responses\Back\Points\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var PointModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param PointModelContract $item
     */
    public function __construct(PointModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return RedirectResponse
     */
    public function toResponse($request): RedirectResponse
    {
        return response()->redirectToRoute('back.social-contest.points.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
