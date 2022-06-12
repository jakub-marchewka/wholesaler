<?php

namespace App\Controller\Admin\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryDeleteController extends AbstractController
{
    #[Route('/admin/category/delete', name: 'app_admin_category_delete')]
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}