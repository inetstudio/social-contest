<?php

namespace InetStudio\SocialContest\Posts\Exports;

use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use InetStudio\SocialContest\Posts\Contracts\Exports\ItemsExportContract;
use InetStudio\SocialContest\Posts\Contracts\Services\Back\ItemsServiceContract;

class ItemsExport implements ItemsExportContract
{
    use Exportable;

    protected ItemsServiceContract $itemsService;

    protected array $data = [];

    public function __construct(ItemsServiceContract $itemsService)
    {
        $this->itemsService = $itemsService;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function query()
    {
        return $this->itemsService->getModel()->query()->with(['social', 'status']);
    }

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
            ($fileUrl) ? url($fileUrl) : '',
        ];
    }

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
            'Ссылка на медиа',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
