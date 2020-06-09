<?php

namespace InetStudio\SocialContest\Statuses\Contracts\Services\Back;

use Illuminate\Support\Collection;

interface UtilityServiceContract
{
    public function getSuggestions(string $search): Collection;
}
