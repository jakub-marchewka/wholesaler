<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Entity\ProductCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryIndexController extends AbstractController
{
    #[Route('/admin/category', name: 'app_admin_category_index')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(ProductCategory::class)->findAll();
        return $this->render("admin/category/index.html.twig", [
            'categories' => $categories
        ]);
    }
}