<?php

declare(strict_types=1);


namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserChangeEmailService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function change(FormInterface $form, User $user): bool
    {
        if ($this->passwordHasher->isPasswordValid($user, $form->get('password')->getData())) {
            $user->setEmail($form->get('email')->getData());
            $this->entityManager->flush();
            return true;
        } else {
            return false;
        }
    }
}