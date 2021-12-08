<?php

declare(strict_types=1);

namespace App\Console;

use App\Integration\Pek\PekClientInterface;
use App\Integration\Sympa\SympaClientInterface;
use App\Transformer\PekUserTransformer;
use App\Transformer\SympaUserTransformer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncCommand extends Command
{
    public function __construct(
        private PekClientInterface $pekClient,
        private PekUserTransformer $pekUserTransformer,
        private SympaClientInterface $sympaClient,
        private SympaUserTransformer $sympaUserTransformer,
        private string $listName
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:users:sync')
            ->setName(sprintf('Felveszi az új felhasználókat a(z) "%s" levlistára', $this->listName))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pekUsers = $this->pekClient->getUsersWithSocialPoints();

        foreach ($pekUsers as $pekUser) {
            $appUser = $this->pekUserTransformer->transform($pekUser);
            $sympaUser = $this->sympaUserTransformer->transformToAddUser($appUser);

            $this->sympaClient->subscribe($this->listName, $sympaUser);
        }

        return self::SUCCESS;
    }
}