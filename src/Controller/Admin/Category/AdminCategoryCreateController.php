<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Entity\ProductCategory;
use App\Form\ProductCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryCreateController extends AbstractController
{
    #[Route('/admin/category/create', name: 'app_admin_category_create')]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new ProductCategory();
        $form = $this->createForm(ProductCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_category_index');
        }
        return $this->render("admin/category/createUpdate.html.twig", [
            'form' => $form->createView()
        ]);
    }
}