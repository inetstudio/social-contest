<?php

namespace InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back;

use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Export\ExportItemsRequestContract;
use InetStudio\SocialContest\Posts\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

interface ExportControllerContract
{
    public function exportItems(ExportItemsRequestContract $request, ItemsExportResponseContract $response): ItemsExportResponseContract;
}
