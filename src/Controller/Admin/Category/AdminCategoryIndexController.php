<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryIndexController extends AbstractController
{
    #[Route('/admin/category', name: 'app_admin_category_index')]
    public function __invoke(): Response
    {
        return $this->render("admin/category/index.html.twig");
    }
}