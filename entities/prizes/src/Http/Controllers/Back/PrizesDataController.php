<?php

namespace InetStudio\SocialContest\Prizes\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SocialContest\Prizes\Contracts\Http\Controllers\Back\PrizesDataControllerContract;

/**
 * Class PrizesDataController.
 */
class PrizesDataController extends Controller implements PrizesDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * PrizesController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\SocialContest\Prizes\Contracts\Services\Back\PrizesDataTableServiceContract');
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
