<?php

namespace App\Command;

use App\Service\Admin\Command\AdminPrivilegesForUserService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:set-admin',
    description: 'Giving admin role for user',
)]
class SetAdminCommand extends Command
{
    public function __construct(
        private AdminPrivilegesForUserService $adminPrivilegesForUserService,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            // configure an argument
            ->addArgument('email', InputArgument::REQUIRED, 'Email.')
            // ...
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $output->writeln([
            'Nadawanie uprawnień administratora',
            '============',
            '',
        ]);
        if ($this->adminPrivilegesForUserService->set($input->getArgument('email'))) {
            $output->writeln('Admin privileges added for: '.$input->getArgument('email'));
        } else {
            $output->writeln('User do not exists');
        }
        // retrieve the argument value using getArgument()
        $output->writeln('Email: '.$input->getArgument('email'));

        return Command::SUCCESS;
    }
}
