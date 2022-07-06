<?php

declare(strict_types=1);


namespace App\Controller\User;

use App\Form\ChangePasswordType;
use App\Service\User\UserChangePasswordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserChangePasswordController extends AbstractController
{
    #[Route('/user/password/change', name: 'app_user_password_change')]
    public function __invoke(Request $request, UserChangePasswordService $changePasswordService): JsonResponse|Response
    {
        $form = $this->createForm(ChangePasswordType::class)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($changePasswordService->changePassword($form, $this->getUser())) {
                return new JsonResponse('good');
            } else {
                $form->get('oldPassword')->addError(new FormError('Password is incorrect'));
            }
        }
        return $this->render('user/changePassword.html.twig', [
            'form' => $form->createView()
        ]);
    }
}