<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Integration\Sympa\Functions\Add\User as SympaAddUser;
use App\Model\User as AppUser;

class SympaUserTransformer
{
    public function transformToAddUser(AppUser $appUser): SympaAddUser
    {
        $sympaUser = new SympaAddUser();
        $sympaUser->setEmail($appUser->getEmail());
        $sympaUser->setGecos($appUser->getName());

        return $sympaUser;
    }
}