<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Integration\Pek\Requests\Users\User;
use App\Model\User as AppUser;

class PekUserTransformer
{
    public function transform(User $user): AppUser
    {
        $appUser = new AppUser();
        $appUser->setName($user->getName());
        $appUser->setEmail($user->getEmail());

        return $appUser;
    }
}