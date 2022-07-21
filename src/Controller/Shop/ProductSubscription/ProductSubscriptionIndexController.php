<?php

declare(strict_types=1);


namespace App\Controller\Shop\ProductSubscription;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductSubscriptionIndexController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/subscriptions', name: 'app_shop_subscriptions_index')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $subscribedProducts = $this->getUser()->getSubscriptions();
        return $this->render('shop/subscription/index.html.twig', [
            'subscribedProducts' => $subscribedProducts
        ]);
    }
}