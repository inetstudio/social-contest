<?php

namespace InetStudio\SocialContest\Prizes\Policies;

use InetStudio\ACL\Users\Models\UserModel;

/**
 * Class PrizeModelPolicy.
 */
class PrizeModelPolicy
{
    public function viewAny(UserModel $user): bool
    {
        return true;
    }

    public function view(UserModel $user): bool
    {
        return true;
    }

    public function create(): bool
    {
        return true;
    }

    public function update(): bool
    {
        return true;
    }

    public function delete(): bool
    {
        return true;
    }
}
