<?php

declare(strict_types=1);

namespace App\Controller\Admin\Vat;

use App\Service\Admin\Vat\ProductVatDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminVatDeleteController extends AbstractController
{
    /**
     * @param Request $request
     * @param ProductVatDeleteService $deleteService
     * @return JsonResponse
     */
    #[Route('/admin/vat/delete', name: 'app_admin_vat_delete')]
    public function __invoke(Request $request, ProductVatDeleteService $deleteService): JsonResponse
    {
        $vatId = $request->get('vatId');
        if ($deleteService->delete($vatId)) {
            return new JsonResponse('good');
        }
        return new JsonResponse('bad');
    }
}