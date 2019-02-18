<?php

namespace InetStudio\SocialContest\Stages\Http\Responses\Back\Stages;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Stages\Contracts\Models\StageModelContract;
use InetStudio\SocialContest\Stages\Contracts\Http\Responses\Back\Stages\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var StageModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param StageModelContract $item
     */
    public function __construct(StageModelContract $item)
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
        return response()->redirectToRoute('back.social-contest.stages.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
