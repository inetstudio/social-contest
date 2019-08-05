<?php

namespace InetStudio\SocialContest\Tags\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Tags\Contracts\Http\Controllers\Back\TagsDataControllerContract;

/**
 * Class TagsDataController.
 */
class TagsDataController extends Controller implements TagsDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Tags\Contracts\Services\Back\TagsDataTableServiceContract');
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
