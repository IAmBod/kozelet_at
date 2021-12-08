<?php

declare(strict_types=1);

namespace App\Integration\Pek;

use App\Integration\Pek\Requests\Users\User;

interface PekClientInterface
{
    /**
     * @return array|User[]
     */
    public function getUsersWithSocialPoints(): array;
}