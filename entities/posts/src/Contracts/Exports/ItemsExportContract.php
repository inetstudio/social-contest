<?php

namespace InetStudio\SocialContest\Posts\Contracts\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

interface ItemsExportContract extends FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
}
