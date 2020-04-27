<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Http\Resources\Back\Resource\Index;

use ArrayAccess;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Routing\UrlRoutable;
use JsonSerializable;

/**
 * Interface ItemResourceContract.
 */
interface ItemResourceContract extends ArrayAccess, JsonSerializable, Responsable, UrlRoutable
{
}
