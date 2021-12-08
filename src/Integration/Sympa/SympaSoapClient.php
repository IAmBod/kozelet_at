<?php

declare(strict_types=1);

namespace App\Integration\Sympa;

use App\Integration\Sympa\Functions\Add\User as AddUser;
use SoapClient;

class SympaSoapClient implements SympaClientInterface
{
    public function __construct(
        private SoapClient $client
    ) {

    }

    public function subscribe(string $listName, AddUser $user, bool $quiet = true): void
    {
        $this->runAuthenticated('add', [
            'listname' => $listName,
            'email' => $user->getEmail(),
            'gecos' => $user->getGecos() ?: $user->getEmail(),
            'quiet' => $quiet
        ]);
    }

    private function runAuthenticated(string $function, array $options): void
    {
        // TODO: do authentication
        $this->client->__soapCall($function, $options);
    }
}