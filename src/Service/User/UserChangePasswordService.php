<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class UserChangePasswordService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function changePassword(FormInterface $form, User $user): bool
    {
        if ($this->passwordHasher->isPasswordValid($user, $form->get('oldPassword')->getData())) {
            $user->setPassword($this->passwordHasher->hashPassword($user, $form->get('newPassword')->getData()));
            $this->entityManager->flush();
            return true;
        } else {
            return false;
        }
    }
}