<?php

namespace InetStudio\SocialContest\Posts\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Posts\Contracts\Http\Controllers\Back\PostsDataControllerContract;

/**
 * Class PostsDataController.
 */
class PostsDataController extends Controller implements PostsDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Posts\Contracts\Services\Back\PostsDataTableServiceContract');
    }

    /**
     * Получаем данные для отображения в таблице.
     *
     * @return mixed
     */
    public function data()
    {
        return $this->services['dataTables']->ajax();
    }
}
