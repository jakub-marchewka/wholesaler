<?php

declare(strict_types=1);


namespace App\Service\Admin\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserActivationService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function activate(string $email): bool
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($user) {
            $user->setActive(true);
            $this->entityManager->flush();
            return true;
        }
        return false;
    }
}