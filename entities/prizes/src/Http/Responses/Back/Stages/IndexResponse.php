<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Prizes;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Prizes\IndexResponseContract;

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
        return view('admin.module.social-contest.prizes::back.pages.index', $this->data);
    }
}
