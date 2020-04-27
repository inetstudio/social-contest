<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\ExportControllerContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

/**
 * Class ExportController.
 */
class ExportController extends Controller implements ExportControllerContract
{
    /**
     * Экспортируем записи.
     *
     * @param  Request  $request
     * @param  ItemsExportResponseContract  $response
     *
     * @return ItemsExportResponseContract
     */
    public function exportItems(Request $request, ItemsExportResponseContract $response): ItemsExportResponseContract
    {
        return $response;
    }
}
