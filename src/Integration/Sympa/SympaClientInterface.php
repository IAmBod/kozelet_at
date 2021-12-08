<?php

declare(strict_types=1);

namespace App\Integration\Sympa;

use App\Integration\Sympa\Functions\Add\User as AddUser;

interface SympaClientInterface
{
    public function subscribe(string $listName, AddUser $user, bool $quiet = true): void;
}