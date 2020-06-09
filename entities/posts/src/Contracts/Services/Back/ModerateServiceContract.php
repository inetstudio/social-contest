<?php

namespace InetStudio\SocialContest\Posts\Contracts\Services\Back;

use InetStudio\SocialContest\Posts\Contracts\Models\PostModelContract;
use InetStudio\SocialContest\Posts\Contracts\DTO\Back\Moderation\Moderate\ItemDataContract;

interface ModerateServiceContract
{
    public function moderate(ItemDataContract $data): PostModelContract;
}
