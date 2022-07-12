<?php

declare(strict_types=1);


namespace App\Controller\User;

use App\Form\ChangeEmailType;
use App\Service\User\UserChangeEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserChangeEmailController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserChangeEmailService $changeEmailService
     * @return JsonResponse|Response
     */
    #[Route('/user/email/change', name: 'app_user_email_change')]
    public function __invoke(Request $request, UserChangeEmailService $changeEmailService): JsonResponse|Response
    {
        $form = $this->createForm(ChangeEmailType::class)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($changeEmailService->change($form, $this->getUser())) {
                return new JsonResponse('good');
            } else {
                $form->get('password')->addError(new FormError('Password is incorrect'));
            }
        }
        return $this->render('user/changeEmail.html.twig', [
            'form' => $form->createView()
        ]);
    }
}