<?php

declare(strict_types=1);


namespace App\Service\Admin\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AdminPrivilegesForUserService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function set(string $email): bool
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if (!empty($user)) {
            $user->setRoles(['ROLE_ADMIN']);
            $this->entityManager->flush();
            return true;
        }
        return false;
    }
}