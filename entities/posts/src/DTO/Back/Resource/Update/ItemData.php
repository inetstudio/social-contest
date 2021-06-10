<?php

declare(strict_types=1);

namespace InetStudio\SocialContest\Posts\DTO\Back\Resource\Update;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\ItemData as PrizeData;
use InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\PivotData as PrizePivotData;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Resource\Update\ItemDataContract;
use InetStudio\SocialContest\Prizes\DTO\Back\Items\Attach\ItemsCollection as PrizesCollection;

class ItemData extends DataTransferObject implements ItemDataContract
{
    public int $id;

    public PrizesCollection $prizes;

    public static function fromRequest(Request $request): self
    {
        $data = [
            'id' => $request->input('id'),
            'prizes' => new PrizesCollection(),
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
