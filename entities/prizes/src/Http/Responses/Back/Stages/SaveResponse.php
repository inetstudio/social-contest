<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Prizes;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Prizes\Contracts\Models\PrizeModelContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Prizes\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var PrizeModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param PrizeModelContract $item
     */
    public function __construct(PrizeModelContract $item)
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
        return response()->redirectToRoute('back.social-contest.prizes.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
