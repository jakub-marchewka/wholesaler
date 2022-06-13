<?php

namespace App\Command;

use App\Service\Admin\Command\UserActivationService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:user-activation',
    description: 'Add a short description for your command',
)]
class UserActivationCommand extends Command
{
    public function __construct(private UserActivationService $activationService, string $name = null)
    {
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Nadawanie uprawnień administratora',
            '============',
            '',
        ]);
        if ($this->activationService->activate($input->getArgument('email'))) {
            $output->writeln('User is now active: '.$input->getArgument('email'));
        } else {
            $output->writeln('User do not exists');
        }
        // retrieve the argument value using getArgument()
        $output->writeln('Email: '.$input->getArgument('email'));

        return Command::SUCCESS;
    }
}
