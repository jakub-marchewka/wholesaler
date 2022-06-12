<?php

namespace App\Controller\Admin\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryIndexController extends AbstractController
{
    #[Route('/admin/category', name: 'app_admin_category_index')]
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}