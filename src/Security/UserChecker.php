<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        // our user entities can be deleted or disabled. If the user is neither, we return with no action
        if (!empty($user->isActive())) {
            return;
        }

        // if we got here, we throw an exception
        throw new DisabledException('User account is disabled.');
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
//        if ($user->isActive()) {
//            echo "test";
//        }
    }
}