<?php

declare(strict_types=1);


namespace App\Controller\Shop\ProductSubscription;

use App\Service\Shop\Subscribtion\SubscribtionSubscribeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductSubscriptionController extends AbstractController
{
    /**
     * @param Request $request
     * @param SubscribtionSubscribeService $subscribeService
     * @return JsonResponse
     */
    #[Route('/subscribe/product', name: 'app_shop_subscribed_subscribe')]
    public function __invoke(Request $request, SubscribtionSubscribeService $subscribeService): JsonResponse
    {
        $productId = $request->get('productId');
        $user = $this->getUser();
        if ($subscribeService->subscribe($productId, $user)) {
            return new JsonResponse('good');
        }
        return new JsonResponse('bad');
    }
}