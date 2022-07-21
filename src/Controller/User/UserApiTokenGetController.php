<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\UserApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserApiTokenGetController extends AbstractController
{
    #[Route('/user/api/token/get', name: 'app_user_api_token_get')]
    public function __invoke(EntityManagerInterface $entityManager): JsonResponse
    {
        $userApiToken = $entityManager->getRepository(UserApiToken::class)->findOneBy(['user' => $this->getUser()]);

        if (!empty($userApiToken)) {
            return new JsonResponse(['status' => 'good', 'token' => $userApiToken->getToken()]);
        } else {
            return new JsonResponse(['status' => 'bad', 'token' => ""]);
        }
    }
}