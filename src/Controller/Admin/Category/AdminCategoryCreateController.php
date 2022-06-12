<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryCreateController extends AbstractController
{
    #[Route('/admin/category/create', name: 'app_admin_category_create')]
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}