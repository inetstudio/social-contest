<?php

namespace InetStudio\SocialContest\Stages\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\SocialContest\Stages\Contracts\Http\Controllers\Back\StagesDataControllerContract;

/**
 * Class StagesDataController.
 */
class StagesDataController extends Controller implements StagesDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * StagesController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Stages\Contracts\Services\Back\StagesDataTableServiceContract');
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
