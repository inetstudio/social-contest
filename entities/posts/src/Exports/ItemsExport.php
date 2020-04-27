<?php

namespace InetStudio\SocialContest\Posts\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use InetStudio\SocialContest\Posts\Contracts\Exports\ItemsExportContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsExport.
 */
class ItemsExport implements ItemsExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @var ItemsServiceContract
     */
    protected ItemsServiceContract $itemsService;

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * Data property setter.
     *
     * @param  array  $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * ItemsExport constructor.
     *
     * @param  ItemsServiceContract  $itemsService
     */
    public function __construct(ItemsServiceContract $itemsService)
    {
        $this->itemsService = $itemsService;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->itemsService->getModel()->with(['social', 'status']);
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function map($item): array
    {
        $fileUrl = ($item['social']->hasMedia('media')) ? url($item['social']->getFirstMediaUrl('media')) : '';

        $prizes = ($item->prizes->count() > 0) ? implode(', ', $item->prizes->pluck('name')->toArray()) : '';

        $prizesDates = '';

        foreach ($item->prizes as $prize) {
            $date = '';
            $date .= ($prize->pivot['date_start']) ? Carbon::createFromFormat('Y-m-d H:i:s', $prize->pivot['date_start'])->format('d.m.Y') : '';
            $date .= ($prize->pivot['date_end']) ? ' - '.Carbon::createFromFormat('Y-m-d H:i:s', $prize->pivot['date_end'])->format('d.m.Y') : '';

            $prizesDates .= ', '.$date;
        }

        $confirmed = '';
        foreach ($item->prizes as $prize) {
            $confirmed .= ', '.(($prize->pivot['confirmed'] == 1) ? 'Да' : 'Нет');
        }

        return [
            $item['id'],
            $item['status']['name'],
            $item->getJSONData('additional_info', 'statusReason', ''),
            $prizes,
            trim($prizesDates, ', '),
            trim($confirmed, ', '),
            $item['social']['social_name'],
            $item['social']['user']['nickname'],
            $item['social']['user']['url'],
            $item['social']['url'],
            $item['social']['caption'],
            Date::dateTimeToExcel($item['created_at']),
            $fileUrl,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Статус',
            'Причина перевода на статус',
            'Призы',
            'Дата приза',
            'Победитель подтвержден',
            'Социальная сеть',
            'Пользователь',
            'Ссылка на пользователя',
            'Ссылка на пост',
            'Содержимое',
            'Дата регистрации в системе',
            'Ссылка на фото',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
