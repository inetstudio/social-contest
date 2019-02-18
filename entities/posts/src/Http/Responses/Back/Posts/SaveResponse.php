<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Posts;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var PostModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param PostModelContract $item
     */
    public function __construct(PostModelContract $item)
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
        return response()->redirectToRoute('back.social-contest.posts.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
