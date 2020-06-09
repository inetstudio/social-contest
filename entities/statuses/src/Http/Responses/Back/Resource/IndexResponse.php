<?php

namespace InetStudio\SocialContest\Statuses\Http\Responses\Back\Resource;

use InetStudio\SocialContest\Statuses\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\SocialContest\Statuses\Contracts\Services\Back\DataTables\IndexServiceContract as DataTableServiceContract;

class IndexResponse implements IndexResponseContract
{
    protected DataTableServiceContract $datatableService;

    public function __construct(DataTableServiceContract $datatableService)
    {
        $this->datatableService = $datatableService;
    }

    public function toResponse($request)
    {
        $table = $this->datatableService->html();

        return view('admin.module.social-contest.statuses::back.pages.index', compact('table'));
    }
}
