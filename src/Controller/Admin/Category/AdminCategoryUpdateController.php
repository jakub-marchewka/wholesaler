<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Entity\ProductCategory;
use App\Form\ProductCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryUpdateController extends AbstractController
{
    /**
     * @param string $categoryId
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return RedirectResponse|Response
     */
    #[Route('/admin/category/update/{categoryId}', name: 'app_admin_category_update')]
    public function __invoke(
        string $categoryId,
        EntityManagerInterface $entityManager,
        Request $request
    ): RedirectResponse|Response {
        $category = $entityManager->getRepository(ProductCategory::class)->findOneBy(['id' => $categoryId]);
        if (empty($category)) {
            $this->addFlash('error', 'Category do not exists');
            return $this->redirectToRoute('app_admin_category_index');
        }
        $form = $this->createForm(ProductCategoryType::class, $category)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Category modified.');
            return $this->redirectToRoute('app_admin_category_index');
        }
        return $this->render('admin/category/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
