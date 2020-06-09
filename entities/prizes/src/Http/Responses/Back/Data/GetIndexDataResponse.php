<?php

namespace InetStudio\SocialContest\Prizes\Http\Responses\Back\Data;

use InetStudio\SocialContest\Prizes\Contracts\Services\Back\DataTables\IndexServiceContract;
use InetStudio\SocialContest\Prizes\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;

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
