<?php

declare(strict_types=1);


namespace App\Controller\Admin\Delivery;

use App\Service\Admin\Delivery\DeliveryDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminDeliveryDeleteController extends AbstractController
{
    #[Route('/admin/delivery/delete', name: 'app_admin_delivery_delete')]
    public function __invoke(Request $request, DeliveryDeleteService $deleteService): JsonResponse
    {
        $deliveryId = $request->get('deliveryId');
        if ($deleteService->delete($deliveryId)) {
            return new JsonResponse('good');
        }
        return new JsonResponse('bad');
    }
}