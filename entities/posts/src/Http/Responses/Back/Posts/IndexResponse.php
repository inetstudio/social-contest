<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Posts;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Posts\IndexResponseContract;

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
        return view('admin.module.social-contest.posts::back.pages.index', $this->data);
    }
}
