<?php

namespace InetStudio\SocialContest\Statuses\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract;

/**
 * Class StatusesDataController.
 */
class StatusesDataController extends Controller implements StatusesDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * StatusesController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract');
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
