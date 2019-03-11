<?php

namespace InetStudio\SocialContest\Posts\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use InetStudio\SocialContest\Posts\Contracts\Exports\PostsExportContract;

/**
 * Class PostsExport.
 */
class PostsExport implements PostsExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        $repository = app()->make('InetStudio\SocialContest\Posts\Contracts\Repositories\PostsRepositoryContract');

        return $repository->getItemsQuery([
            'columns' => ['hash', 'search_data', 'created_at', 'updated_at'],
            'relations' => ['social', 'status']
        ]);
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function map($item): array
    {
        $fileUrl = ($item->social->hasMedia('media')) ? $item->social->getFirstMediaUrl('media') : '';

        return [
            $item['id'],
            $item['status']['name'],
            $item['social']['social_name'],
            $item['social']['user']['nickname'],
            $item['social']['user']['url'],
            $item['social']['url'],
            $item['social']['caption'],
            Date::dateTimeToExcel($item['created_at']),
            url($fileUrl),
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
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
