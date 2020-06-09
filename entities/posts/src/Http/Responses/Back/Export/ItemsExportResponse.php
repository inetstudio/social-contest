<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Export;

use Maatwebsite\Excel\Facades\Excel;
use InetStudio\SocialContest\Posts\Contracts\Exports\ItemsExportContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

class ItemsExportResponse implements ItemsExportResponseContract
{
    protected ItemsExportContract $export;

    public function __construct(ItemsExportContract $export)
    {
        $this->export = $export;
    }

    public function toResponse($request)
    {
        $data = [
            'route' => $request->route()->parameters(),
            'request' => $request->all(),
        ];

        $this->export->setData($data);

        return Excel::download($this->export, time().'.xlsx');
    }
}
