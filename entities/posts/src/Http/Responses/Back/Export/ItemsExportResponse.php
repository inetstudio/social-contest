<?php

namespace InetStudio\SocialContest\Posts\Http\Responses\Back\Export;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use InetStudio\SocialContest\Posts\Contracts\Exports\ItemsExportContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

/**
 * Class ItemsExportResponse.
 */
class ItemsExportResponse implements ItemsExportResponseContract
{
    /**
     * @var ItemsExportContract
     */
    protected ItemsExportContract $export;

    /**
     * ItemsExportResponse constructor.
     *
     * @param  ItemsExportContract  $export
     */
    public function __construct(ItemsExportContract $export)
    {
        $this->export = $export;
    }

    /**
     * Экспорт данных.
     *
     * @param  Request  $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
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
