<?php

declare(strict_types=1);


namespace App\Service\User;

use App\Entity\Response;
use App\Entity\User;
use App\Entity\UserApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\Uid\Uuid;

class UserGenerateApiTokenService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function generate(User $user): ?string
    {
        $apiToken = $this->entityManager->getRepository(UserApiToken::class)->findOneBy(['user' => $user]);
        if (empty($apiToken)) {
            $apiToken = new UserApiToken();
            $apiToken->setUser($user);
            $apiToken->setToken(ByteString::fromRandom(32)->toString());
            $this->entityManager->persist($apiToken);
            $this->entityManager->flush();
        }
        return $apiToken->getToken();
    }
}