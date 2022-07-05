<?php

declare(strict_types=1);


namespace App\Controller\User;

use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserChangePasswordController extends AbstractController
{
    #[Route('/user/password/change', name: 'app_user_password_change')]
    public function __invoke(Request $request)
    {
        $form = $this->createForm(ChangePasswordType::class)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return new JsonResponse('good');
        }
        return $this->render('user/changePassword.html.twig', [
            'form' => $form->createView()
        ]);
    }
}