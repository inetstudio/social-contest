@if ($item)
    @php
        $date = '';
        $date .= ($item['prize_date_start']) ? $item['prize_date_start']->format('d.m.Y') : '';
        $date .= ($item['prize_date_end']) ? ' - '.$item['prize_date_end']->format('d.m.Y') : '';
    @endphp
    <span class="label {{ ($item['prize_mail']) ? 'label-primary' : 'label-default' }}">{{ $item['prize']['name'] }}{{ ($date) ? ' ('.$date.')' : '' }}</span>
@endif
