<?php

declare(strict_types=1);


namespace App\Controller\User;

use App\Service\User\UserGenerateApiTokenService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserApiTokenGenerateController extends AbstractController
{
    #[Route('/user/api/token/generate', name: 'app_user_api_token_generate')]
    public function __invoke(UserGenerateApiTokenService $apiTokenService): JsonResponse
    {
        return new JsonResponse($apiTokenService->generate($this->getUser()));
    }
}