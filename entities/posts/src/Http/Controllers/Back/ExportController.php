<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ExportControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Export\ExportItemsRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

class ExportController extends Controller implements ExportControllerContract
{
    public function exportItems(ExportItemsRequestContract $request, ItemsExportResponseContract $response): ItemsExportResponseContract
    {
        return $response;
    }
}
