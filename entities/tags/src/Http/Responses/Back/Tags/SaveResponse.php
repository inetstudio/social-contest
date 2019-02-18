<?php

namespace InetStudio\SocialContest\Tags\Http\Responses\Back\Tags;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Tags\Contracts\Models\TagModelContract;
use InetStudio\SocialContest\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var TagModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param TagModelContract $item
     */
    public function __construct(TagModelContract $item)
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
        return response()->redirectToRoute('back.social-contest.tags.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
