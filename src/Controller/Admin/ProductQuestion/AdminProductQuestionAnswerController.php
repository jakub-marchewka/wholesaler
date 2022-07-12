<?php

declare(strict_types=1);


namespace App\Controller\Admin\ProductQuestion;

use App\Entity\ProductQuestion;
use App\Form\ProductQuestionAnswerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductQuestionAnswerController extends AbstractController
{
    /**
     * @param string $questionId
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
    #[Route('/admin/product/question/{questionId}', name: 'app_admin_question_answer')]
    public function __invoke(
        string $questionId,
        Request $request,
        EntityManagerInterface $entityManager
    ): RedirectResponse|Response {
        $productQuestion = $entityManager->getRepository(ProductQuestion::class)->findOneBy(['id' => $questionId]);
        if (empty($productQuestion)) {
            return $this->redirectToRoute('app_admin_product_question_index');
        }
        $form = $this->createForm(ProductQuestionAnswerType::class, $productQuestion)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $productQuestion->setAnswered(true);
            $productQuestion->setAnsweredAt(new \DateTimeImmutable());
            $entityManager->flush();
            $this->addFlash('success', 'You have answered to question.');
            return $this->redirectToRoute('app_admin_product_question_index');
        }
        return $this->render('admin/question/answer.html.twig', [
            'form' => $form->createView()
        ]);
    }
}