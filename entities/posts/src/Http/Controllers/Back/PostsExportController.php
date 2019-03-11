<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsExportControllerContract;

/**
 * Class PostsExportController.
 */
class PostsExportController extends Controller implements PostsExportControllerContract
{
    /**
     * Скачиваем посты.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportPosts()
    {
        $export = app()->make('InetStudio\SocialContest\Posts\Contracts\Exports\PostsExportContract');

        return Excel::download($export, time().'.xlsx');
    }
}
