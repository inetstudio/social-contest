<?php

namespace InetStudio\SocialContest\Points\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Points\Contracts\Http\Controllers\Back\PointsDataControllerContract;

/**
 * Class PointsDataController.
 */
class PointsDataController extends Controller implements PointsDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * PointsController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Points\Contracts\Services\Back\PointsDataTableServiceContract');
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
