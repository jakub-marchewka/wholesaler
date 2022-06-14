<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Service\Admin\ProductCategory\ProductCategoryDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryDeleteController extends AbstractController
{
    #[Route('/admin/category/delete', name: 'app_admin_category_delete')]
    public function __invoke(Request $request, ProductCategoryDeleteService $deleteService): JsonResponse
    {
        $categoryId = $request->get('categoryId');
        if ($deleteService->delete($categoryId)) {
            return new JsonResponse('good');
        }
        return new JsonResponse('bad');
    }
}
