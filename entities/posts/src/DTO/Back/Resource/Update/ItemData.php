<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO\Back\Resource\Update;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\ItemData as PrizeData;
use InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\PivotData as PrizePivotData;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Update\ItemDataContract;

class ItemData extends DataTransferObject implements ItemDataContract
{
    public int $id;

    /** @var \InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\ItemData[] */
    #[CastWith(ArrayCaster::class, itemType: PrizeData::class)]
    public array $prizes;

    public static function fromRequest(Request $request): self
    {
        $data = [
            'id' => $request->input('id'),
            'prizes' => [],
        ];

        foreach ($request->input('prizes', []) as $prize) {
            $data['prizes'][] = new PrizeData(
                [
                    'id' => $prize['id'],
                    'pivot' => PrizePivotData::prepareData($prize['pivot'])
                ]
            );
        }

        return new self($data);
    }
}
