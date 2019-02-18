<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Statuses;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract;

/**
 * Class IndexResponse.
 */
class IndexResponse implements IndexResponseContract, Responsable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * IndexResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии списка объектов.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.social-contest.statuses::back.pages.index', $this->data);
    }
}
