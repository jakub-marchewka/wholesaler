<?php

namespace App\Command;

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
    protected function configure(): void
    {
        $this
            // configure an argument
            ->addArgument('email', InputArgument::REQUIRED, 'Email.')
            // ...
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Nadawanie uprawnień administratora',
            '============',
            '',
        ]);
//        if ($this->adminService->setAdmin($input->getArgument('email'))) {
//            $output->writeln('Prawa administratora zostały nadane dla: '.$input->getArgument('email'));
//        } else {
//            $output->writeln('Nie ma użytkownika z takim emailem');
//        }
        // retrieve the argument value using getArgument()
        $output->writeln('Email: '.$input->getArgument('email'));

        return Command::SUCCESS;
    }
}
