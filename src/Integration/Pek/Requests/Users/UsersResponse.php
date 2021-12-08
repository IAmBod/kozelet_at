<?php

declare(strict_types=1);

namespace App\Integration\Pek\Requests\Users;

class UsersResponse
{
    /**
     * @var array|User[]
     */
    private array $users = [];

    /**
     * @return array|User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param array|User[] $users
     * @return void
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}