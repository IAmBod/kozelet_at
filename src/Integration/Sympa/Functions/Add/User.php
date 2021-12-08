<?php

declare(strict_types=1);

namespace App\Integration\Sympa\Functions\Add;

class User
{
    /**
     * the email to subscribe to the list
     *
     * @var string
     */
    private string $email = '';

    /**
     * the name under which this email will be subscribed (for example: “John Doe”)
     *
     * @var string
     */
    private string $gecos = '';

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getGecos(): string
    {
        return $this->gecos;
    }

    public function setGecos(string $gecos): void
    {
        $this->gecos = $gecos;
    }
}