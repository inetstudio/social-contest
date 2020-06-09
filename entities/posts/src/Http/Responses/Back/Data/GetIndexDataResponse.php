<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Data;

use InetStudio\SocialContest\Posts\Contracts\Services\Back\DataTables\IndexServiceContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

class GetIndexDataResponse implements GetIndexDataResponseContract
{
    protected IndexServiceContract $dataService;

    public function __construct(IndexServiceContract $dataService)
    {
        $this->dataService = $dataService;
    }

    public function toResponse($request)
    {
        return $this->dataService->ajax();
    }
}
